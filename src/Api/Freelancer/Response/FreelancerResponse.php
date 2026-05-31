<?php

declare(strict_types=1);

namespace Mellow\Api\Freelancer\Response;

final class FreelancerResponse
{
    public function __construct(
        public readonly int $id,
        public readonly string $uuid,
        public readonly string $email,
        public readonly string $name,
        public readonly int $taxationStatusId,
        public readonly ?string $taxationBlockedTill,
        public readonly ?string $categoryTitle,
        public readonly ?string $categoryTitleEn,
        public readonly array $details,
        public readonly bool $isVerified,
        public readonly ?string $country,
        public readonly bool $isInviteSent,
        public readonly ?\DateTimeImmutable $inviteSentAt,
        public readonly ?string $actualRegDate,
        public readonly ?string $dateVerified,
        public readonly bool $isRegistered,
        public readonly bool $isTaxPaymentAllowed,
        public readonly int $emailConfirmationStatus,
        public readonly int $phoneConfirmationStatus,
        public readonly ?string $phone,
    ) {
    }
}
