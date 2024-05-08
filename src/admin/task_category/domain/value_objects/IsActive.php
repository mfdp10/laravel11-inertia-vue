<?php

namespace Src\admin\task_category\domain\value_objects;

use Src\admin\shared\domain\exceptions\MinLengthException;
use Src\admin\shared\domain\exceptions\MaxLengthException;

final class IsActive
{
    const MAX_LENGTH = 3;
    const MIN_LENGTH = 1;

    private string $value;

    function __construct(string $value = "yes")
    {
        if (!self::ensureSatisfyMinLenght($value)) {
            $message = "IsActive field need to have at least " . self::MIN_LENGTH . " characters.";
            throw new MinLengthException($message);
        }
        if (!self::ensureSatisfyMaxLenght($value)) {
            $message = "IsActive field need to have less than " . self::MAX_LENGTH . " characters.";
            throw new MaxLengthException($message);
        }

        $this->value = $value;
    }

    function __invoke()
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function ensureSatisfyMaxLenght(string $value): bool
    {
        return strlen($value) <= self::MAX_LENGTH;
    }

    private function ensureSatisfyMinLenght(string $value): bool
    {
        return strlen($value) >= self::MIN_LENGTH;
    }
}
