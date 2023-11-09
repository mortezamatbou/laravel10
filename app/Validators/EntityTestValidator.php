<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class EntityTestValidator.
 *
 * @package namespace App\Validators;
 */
class EntityTestValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'age' => 'required|digits_between:1,100',
            'field' => 'required|in:IT,HW,SW',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'age' => 'required|digits_between:1,100',
            'field' => 'required|in:IT,HW,SW',
        ],
    ];
}
