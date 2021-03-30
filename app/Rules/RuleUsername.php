<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class RuleUsername implements Rule
{

     /**
     * variable name
     *
     * @var [string]
     */
    protected $user;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $message;

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
            return $this->fail('Username '.$value.' tidak ada di database');
        };
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
