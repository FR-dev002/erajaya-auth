<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class RulePassword implements Rule
{

    protected $user;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?User $user)
    {
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(is_null($this->user)) {
            return $this->fail('User tidak ditemukan');
        };

        // Check password match
         if (!Hash::check($value, $this->user->password)) {
             $this->fail('password anda salah');
        }

        return true;

    }

    protected function fail($message) {
        $this->message = $message;
        return false;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
