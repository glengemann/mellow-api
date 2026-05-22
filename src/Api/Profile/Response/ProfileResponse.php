<?php

declare(strict_types=1);

namespace Mellow\Api\Profile\Response;

final readonly class ProfileResponse
{
    public function __construct(
        public ?string $postCode,
        public ?string $physicalAddress,
        public ?string $city,
        public ?string $inn,
        public string $ip,
        public ?string $birthDate,
        /** @var array<string, mixed>|null */
        public ?array $gridsSettings,
        public bool $loginNotification,
        public ?int $avatarFileId,
        public ?string $avatarFileUrl,
        public bool $isRedesignEnabled,
        public bool $showRedesignBanner,
        public int $id,
        public string $uuid,
        public string $email,
        public bool $emailConfirmed,
        public string $username,
        public ?string $firstName,
        public ?string $middleName,
        public ?string $lastName,
        public string $regDate,
        public string $twoFaMethod,
        public int $taxationStatus,
        public string $phone,
        public bool $phoneConfirmed,
        public string $country,
        public ?string $citizenship,
        public ?string $birthCountry,
        public ?string $state,
        public int $flags,
        public string $type,
        public ?string $defaultSmsGate,
        public string $language,
        public bool $isVerified,
        public int $typeVerified,
        public ?string $specialization,
        public ?string $taxationBlockedTill,
        public ?string $selfEmployedLinkedAt,
        public bool $shouldChangePassword,
        public ?string $altName,
        public ?string $russianInn,
        public string $languageStringValue,
        public string $name,
    ) {
    }
}
