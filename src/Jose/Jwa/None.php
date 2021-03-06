<?php

declare(strict_types=1);

namespace IdentityLayer\Jose\Jwa;

use IdentityLayer\Jose\JwaEnum;
use IdentityLayer\Jose\Exception\NoneAlgorithmException;
use IdentityLayer\Jose\Jwa;
use IdentityLayer\Jose\Jwk\SigningKey;
use IdentityLayer\Jose\Jwk\VerificationKey;

/**
 * Whilst this algorithm is part of the JWA spec, it should not be used in most cases.
 */
final class None implements Jwa
{
    public function name(): JwaEnum
    {
        return JwaEnum::NONE();
    }

    public function sign(SigningKey $key, string $message): string
    {
        throw new NoneAlgorithmException('Cannot sign a message using "none" algorithm.');
    }

    public function verify(VerificationKey $key, string $message, string $signature): bool
    {
        throw new NoneAlgorithmException('Cannot verify a message that uses the "none" algorithm.');
    }
}
