<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Collection;

class RuleEmail implements Rule
{
    /**
     * variable name
     *
     * @var [string]
     */
    protected $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?Collection $user)
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
        if(count($this->user)) {
            return $this->fail('User dengan '.$attribute.' '.$value.' sudah ada di database');
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
