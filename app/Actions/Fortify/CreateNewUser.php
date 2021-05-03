<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        // if(!empty($input['type'])){
        // if($input['type']=="entreprenuer"){
            // Validator::make($input, [
            //     'full_name' => ['required', 'string', 'max:255'],
            //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //     'password' => $this->passwordRules('password_confirmation'),
            //     'country' => ['required', 'string', 'max:255'],
            //     'province' => ['required', 'string', 'max:255'],
            //     'phone' => ['required', 'string', 'max:255'],
            //     'gender' => ['required', 'string', 'max:255'],
            //     'how_did_you_hear_about_us' => ['required', 'string', 'max:255'],
            //     'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            // ])->validate();

            // return User::create([
            //     'name' => $input['full_name'],
            //     'email' => $input['email'],
            //     'phone_number' => $input['phone'],
            //     'role' => $input['type'],
            //     'gender' => $input['gender'],
            //     'how_did_you_hear' => $input['how_did_you_hear_about_us'],
            //     'country' => $input['country'],
            //     'province' => $input['province'],
            //     'password' => Hash::make($input['password']),
            // ]);
    
        // }
    //     if($input['type']=="mentor"){
    //         Validator::make($input, [
    //             'full_name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //             'password' => $this->passwordRules('password_confirmation'),
    //             'country' => ['required', 'string', 'max:255'],
    //             'province' => ['required', 'string', 'max:255'],
    //             'phone' => ['required', 'string', 'max:255'],
    //             'gender' => ['required', 'string', 'max:255'],
    //             'how_did_you_hear_about_us' => ['required', 'string', 'max:255'],
    //             'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
    //         ])->validate();

    //         return User::create([
    //             'name' => $input['full_name'],
    //             'email' => $input['email'],
    //             'phone_number' => $input['phone'],
    //             'role' => $input['type'],
    //             'gender' => $input['gender'],
    //             'how_did_you_hear' => $input['how_did_you_hear_about_us'],
    //             'country' => $input['country'],
    //             'province' => $input['province'],
    //             'password' => Hash::make($input['password']),
    //         ]);
    //     }else{
    //         Validator::make($input, [
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //             'password' => $this->passwordRules(),
    //             'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
    //         ])->validate();
    
    //         return User::create([
    //             'name' => $input['name'],
    //             'email' => $input['email'],
    //             'password' => Hash::make($input['password']),
    //         ]);
    //     }
    // }else{
    
    //     ]);
    // }
       


    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
    ])->validate();

    return User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ]);

    }
}
