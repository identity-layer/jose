<?php

declare(strict_types=1);

namespace IdentityLayer\Jose\Claim;

use DateTimeImmutable;
use Exception;
use IdentityLayer\Jose\Claim;
use IdentityLayer\Jose\Exception\InvalidArgumentException;

class TimestampClaim implements Claim
{
    private string $key;
    private DateTimeImmutable $value;

    private function __construct(string $key, int $timestamp)
    {
        try {
            $dateTime = DateTimeImmutable::createFromFormat('U', (string) $timestamp);
            if ($dateTime === false) {
                throw new Exception();
            }
        } catch (Exception $e) {
            throw new InvalidArgumentException(
                sprintf('Invalid timestamp %d', $timestamp)
            );
        }

        $this->key = $key;
        $this->value = $dateTime;
    }

    /**
     * @param string $key
     * @param int $value
     * @return Claim
     */
    public static function fromKeyValue(string $key, $value): Claim
    {
        return new TimestampClaim($key, $value);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value->getTimestamp();
    }

    public function jsonSerialize(): array
    {
        return [
            $this->key => $this->value->getTimestamp()
        ];
    }
}
