<?php 

namespace Core;

use DateTime;
use Exception;

trait Validation 
{
    /**
     * Validation errors
     *
     * @var array
     */
    private array $errors = [];

    /**
     * Return errors array
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Parse given rules and execute validation functions
     *
     * @param $rules
     */
    public function validate($rules): void
    {
        foreach ($rules as $key => $rule) {
            if (strpos($rule, 'required') !== false) {
                $this->validateRequired($key);
            }

            if (strpos($rule, 'date') !== false) {
                $this->validateDate($key);
            }
        }
    }

    /**
     * Validate the field for characters
     *
     * @param $key
     */
    private function validateRequired($key): void
    {
        $value = $this->$key;

        if (!isset($value) && trim($value) === '') {
            $this->errors[$key][] = 'Поле обязательно к заполнению';
        }
    }

    /**
     * Validate the field for correct date
     *
     * @param $key
     */
    private function validateDate($key): void
    {
        $value = $this->$key;

        try {
            $date = new DateTime($value);
            if ($date->format('Y-m-d') !== $value) {
                throw new Exception('Некоректная дата');
            }
        } catch (Exception $e) {
            $this->errors[$key][] = $e->getMessage();
        }
    }
}
