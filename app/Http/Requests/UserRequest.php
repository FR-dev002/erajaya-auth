<?php

namespace App\Http\Requests;

use App\Rules\RuleEmail;
use App\Repositories\User\UserInterface;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private $userRepository;

    public function __construct(UserInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                new RuleEmail($this->getUserEmail())
            ],
            'password' => [
                'required',
            ],
            'role' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required ',
            'email.required' => 'Email is required',
            'password.required' => 'Password is Required',
            'role.required' => 'Role is Required'
        ];
    }

    public function getUserEmail()
    {

        /**
         * saat Edit data akan menjalankan fungsi ini
         */
        if($this->id){
            return $this->userRepository->findByExcept('email', $this->email, $this->id);
        }

        /**
         * @desc saat email null makan akan langsung mengembalikan nulai null
         */
        if(is_null($this->email)){
            return null;
        }


        /**
         * @desc find user by email
         */
        return $this->userRepository->findBy('email', $this->email);
    }

}


