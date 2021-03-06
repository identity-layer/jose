<?php

declare(strict_types=1);

namespace IdentityLayer\Jose\Claim;

use IdentityLayer\Jose\Claim;
use IdentityLayer\Jose\Exception\InvalidArgumentException;

class EmailClaim implements Claim
{
    private string $key;
    private string $value;

    private function __construct(string $key, string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException(
                sprintf('%s is not a valid email address', $email)
            );
        }

        $this->key = $key;
        $this->value = $email;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Claim
     */
    public static function fromKeyValue(string $key, $value): Claim
    {
        return new EmailClaim($key, $value);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize(): array
    {
        return [
            $this->key => $this->value
        ];
    }
}
