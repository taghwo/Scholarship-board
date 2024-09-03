<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationList;

class ValidationException extends \Exception
{
    public int $status = 422;

    public function __construct(private readonly ConstraintViolationList $errors)
    {
        parent::__construct(self::transform());
    }

    private function transform(): string
    {
        $errors = [
            'message' => 'Invalid data given',
        ];

        foreach ($this->errors as $error) {
            $errors['errors'][] = [
                $error->getPropertyPath() => $error->getMessage(),
            ];
        }

        return json_encode($errors);
    }

    public function all(): array
    {
        return json_decode($this->transform(), true);
    }
}
