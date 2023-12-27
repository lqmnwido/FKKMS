<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $uID = rand(10000, 99999);

        if ($input['MatricID'] == null) {
            $userType = 'Vendor';
            $matricID = Null;
            $UID = 'VEN'.$uID;
        }else{
            $userType = 'FK Student';
            $matricID = $input['MatricID'];
            $UID = 'STD'.$uID;
        }

        
        return User::create([
            'User_ID' => $UID,
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'MatricID' => $input['MatricID'],
            'company' => $input['company'],
            'User_type' => $userType,
        ]);
    }
}
