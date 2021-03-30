<?php

namespace App\Http\Requests;

use App\Repositories\User\UserInterface;
use App\Rules\RuleUsername;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RulePassword;

class LoginRequest extends FormRequest
{

    private $userRepository;
    private $user;

    public function __construct(UserInterface $userRepository)
    {
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
     *  username => required,
     * @return array
     */
    public function rules()
    {
        return [
            'username' => [
                'required',
                'min:5',
                new RuleUsername($this->getUserModel())
            ],
            'password' => [
                'required',
                'min:5',
                new RulePassword($this->getUserModel())
            ]
        ];
    }

    /**
     * @desc Custom message yang akan di kembalikan ke frontend
     */
    function messages()
    {
        return [
            'username.min' => 'username minimal 5 karakter',
            'username.required' => 'username harus diisi email',
            'password.required' => 'Password harus diisi ',
            'password.min' => 'Password Minimal 5 karakter '
        ];
    }


    /**
     * @desc Get data user bedasarkan username
     */
    public function getUserModel()
    {
        if (is_null($this->username)) {
            return null;
        }


        if (is_null($this->user)) {
            $this->user = $this->userRepository->findByUsername('email', $this->username);
        }
        return $this->user;
    }

}
