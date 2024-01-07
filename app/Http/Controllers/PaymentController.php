<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = request('type');

        $applications = Application::all();
        $users = User::all();
        $payments = Payment::all();
        $uid = Auth::user()->User_ID;

        $application = $applications->where("User_ID", $uid)->first();
        $payment = $payments->where("User_ID", $uid)->first();
        $role = Auth::user()->User_type;

        if ($role == 'FK Student' || $role == 'Vendor') {
            return view('manage_payment.mainPayment', compact('users', 'application', 'payment', 'role'));

        }elseif ($role == 'FK Bursary') {
            return view('manage_payment.paymentList', compact('users', 'applications', 'payments', 'type'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $type, string $id)
    {
        $feeType = $type;
        $applications = Application::all();
        $users = User::all();
        $payments = Payment::all();
        $uid = Auth::user()->User_ID;

        $application = $applications->where("User_ID", $uid)->first();
        $payment = $payments->where("User_ID", $uid)->first();
        $user = $users->where("User_ID", $uid)->first();
        $role = Auth::user()->User_type;

        if ($role == 'FK Student' || $role == 'Vendor') {
            return view('manage_payment.paymentAdd', compact('user', 'application', 'payment', 'feeType'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $month = date('m');
        $date = date("Y-m-d");
        $expires = strtotime('+2 days', strtotime($date));
        $ranID = rand(10000, 99999);
        $paymentID = 'PAY' . $ranID;

        if ($request['paymentOpt'] == 'CDM') {
            $receipt = $request->file('receipt');
            $rand = rand(10000, 99999);
            $receiptID = "RECEIPT_" . $rand;
            $receiptName = $receipt->extension();
            $receipts = $receiptID . '.' . $receiptName;

            $path = 'uploads/'. $receiptID . '.' . $receiptName;
            
            Storage::disk('public')->put($path,file_get_contents($receipt));
        } else {

            $billName = $request['feeType'];
            $description = $paymentID;
            $decimal = (int) ($request['total'] * 100);
            $amount = $decimal;
            $refNo = $paymentID;
            $name = $request['name'];
            $email = $request['email'];
            $phone = $request['phone'];

            $receipts = null;
            Payment::create([
                'Payment_ID' => $paymentID,
                'User_ID' => $request['uID'],
                'PaymentType' => $request['feeType'],
                'PaymentMonth' => $month,
                'PaymentDate' => $date,
                'Total_Price' => $request['total'],
                'remark' => 'Pending',
                'paymentOpt' => $request['paymentOpt'],
                'receipt' => $receipts,
            ]);
            return redirect()->route('toyyibpay-create', compact('billName', 'description', 'amount', 'refNo', 'name', 'email', 'phone', 'expires'));


        }

        Payment::create([
            'Payment_ID' => $paymentID,
            'User_ID' => $request['uID'],
            'PaymentType' => $request['feeType'],
            'PaymentMonth' => $month,
            'PaymentDate' => $date,
            'Total_Price' => $request['total'],
            'remark' => 'Pending',
            'paymentOpt' => $request['paymentOpt'],
            'receipt' => $receipts,
        ]);



        return redirect()->route('payments.index')->with('success', 'Payment Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //PAYMENT GATEWAY
    public function createBill($billName, $description, $amount, $refNo, $name, $email, $phone, $expires)
    {

        $expire = date("Y-m-d", $expires);

        $receipts = array(
            'userSecretKey' => 'hu7sij8w-6y30-ymrs-chmw-eakjreybb8q4',
            'categoryCode' => 'qijythvv',
            'billName' => $billName,
            'billDescription' => $description,
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => $amount,
            'billReturnUrl' => route('toyyibpay-status'),
            'billCallbackUrl' => route('toyyibpay-callback'),
            'billExternalReferenceNo' => $refNo,
            'billTo' => $name,
            'billEmail' => $email,
            'billPhone' => $phone,
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => 0,
            'billContentEmail' => 'Thank you for paying your fee!',
            'billChargeToCustomer' => 1,
            'billExpiryDate' => $expire,
            'billExpiryDays' => 2
        );


        echo ' </br>';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $receipts);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        // Decode the JSON response
        $response = json_decode($result, true); // Set the second parameter to true to get an associative array

        // Check if decoding was successful and 'BillCode' is present
        if (is_array($response) && isset($response[0]['BillCode'])) {
            $billCode = $response[0]['BillCode'];
            return redirect('https://dev.toyyibpay.com/'. $billCode);
        } else {
            echo 'Failed to retrieve BillCode from the response.';
        }

    }

    public function paymentStatus()
    {
        $response = request()->all(['status_id', 'billcode', 'order_id', 'billName']);
        
        $status = $response['status_id'];
        $id = $response['order_id'];

        if ($status == '1') {
            Payment::where('Payment_ID', $id)->update([
                'remark' => 'Successful',
            ]);
            return redirect()->route('payments.index')->with('success', 'Payment Successful!');
        }elseif ($status == '3') {
            Payment::where('Payment_ID', $id)->update([
                'remark' => 'Unsuccessful',
            ]);
            return redirect()->route('payments.index')->with('alert', 'Payment Unsuccessful!');
        }else{
            Payment::where('Payment_ID', $id)->update([
                'remark' => 'Pending',
            ]);
        }
        return redirect()->route('payments.index')->with('alert', 'Payment Pending!');
    }



    public function callBack()
    {
        $response = request()->all(['refno', 'status','reason','billcode', 'order_id', 'amount']);
        Log::info($response);
    }

    public function approve(Request $request)
    {
        $Payment_ID = $request['id'];
        $status = 'Approved';
        $type = $request['type'];
        Payment::where('Payment_ID', $Payment_ID )->update([
            'remark' => $status,
        ]);

        return redirect()->route('payments.index', ['type' => $type])->with('Approve', $Payment_ID.' Has Been Approved');
    }

    public function reject(Request $request)
    {
        $Payment_ID = $request['id'];
        $status = 'Rejected';
        $type = $request['type'];
        Payment::where('Payment_ID', $Payment_ID )->update([
            'remark' => $status,
        ]);

        return redirect()->route('payments.index', ['type' => $type])->with('Reject', $Payment_ID.' Has Been Rejected');
    }
}
