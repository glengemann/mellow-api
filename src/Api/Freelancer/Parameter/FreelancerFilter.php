<?php

declare(strict_types=1);

namespace Mellow\Api\Freelancer\Parameter;

class FreelancerFilter
{
    /**
     * @param array{
     *     isVerified?: bool,
     *     isInviteEmailSent?: bool,
     *     dateInvitedFrom?: string,
     *     dateInvitedTo?: string,
     * } $parameters
     */
    public function __construct(
        private array $parameters = [],
    ) {
    }

    public function toArray(): array
    {
        return $this->parameters;
    }

    /** Indicates whether the freelancer account is verified */
    public function isVerified(bool $true): self
    {
        $this->parameters['isVerified'] = $true;

        return $this;
    }

    /** Indicates whether an invitation has been sent to the freelancer */
    public function isInviteEmailSent(bool $isInviteEmailSent): self
    {
        $this->parameters['isInviteEmailSent'] = $isInviteEmailSent;

        return $this;
    }

    /** Invite date (start of an interval) */
    public function dateInvitedFrom(\DateTimeImmutable $dateInvitedFrom): self
    {
        $this->parameters['dateInvitedFrom'] = $dateInvitedFrom->format('Y-m-d');

        return $this;
    }

    /** Invite date (end of an interval) */
    public function dateInvitedTo(\DateTimeImmutable $dateInvitedTo): self
    {
        $this->parameters['dateInvitedTo'] = $dateInvitedTo->format('Y-m-d');

        return $this;
    }
}
