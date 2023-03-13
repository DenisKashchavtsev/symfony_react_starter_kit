<?php

namespace App\Model;

class ErrorValidation
{
    private array $violations = [];

    public function addViolation(string $field, string $message): void
    {
        $this->violations[$field] = $message;
    }

    public function getViolations(): array
    {
        return $this->violations;
    }
}
