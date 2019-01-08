<?php


namespace App\Validators;

use App\Exceptions\ValidationFailedException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterNewUserValidator extends Validator implements ValidatorInterface
{
    /**
     * @author Damilare Emmanuel <d.dammylarry@gmail.com>
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function run($data)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ];
        
        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json([
                'success'=> false,
                'error'=> json_decode($error)]);
        }
    }
}
