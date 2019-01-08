<?php

namespace App\Http\Traits;

use App\User;
use Illuminate\Support\Facades\Hash;

trait UserRegistrationTrait
{
    /**
     * @author Damilare Emmanuel <d.dammylarry@gmail.com>
     * @param $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public static function createNewUser($payload)
    {
        $email = array_get($payload, 'email');
        $password = array_get($payload, 'password');
        $name = array_get($payload, 'name');

        $userUser = new User;
        $userUser->email = $email;
        $userUser->name = $name;
        $userUser->password = Hash::make($password);
        
        if ($userUser->save()) {
            return response()->json([
                'success'=> true, 
                'message'=> 'Thanks for signing up! Please check your email to complete your registration.'
                ]);
        }
        response()->json([
            'success'=> false, 
            'error'=> "Registration failed."
            ]);
    }
}
