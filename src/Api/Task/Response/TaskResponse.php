<?php

declare(strict_types=1);

namespace Mellow\Api\Task\Response;

class TaskResponse
{
    public function __construct(
        public readonly array $attributes,
        /** @var list<array<string, mixed>> */
        public readonly array $messages,
        public readonly array $creator,
        public readonly int $id,
        public readonly string $uuid,
        public readonly string $token,
        public readonly string $title,
        public readonly string $description,
        public readonly float $price,
        public readonly float $priceInWorkerCurrency,
        public readonly float $priceWithCommission,
        public readonly float $commissionAmount,
        public readonly float $commissionAmountInWorkerCurrency,
        public readonly float $commissionPercent,
        public readonly int $companyId,
        /** @var list<array<string, mixed>> */
        public readonly array $actions,
        /** @var array<string, mixed>|null */
        public readonly ?array $additionalAttributes,
        public readonly array $service,
        public readonly array $category,
        public readonly array $deadline,
        public readonly array $hold,
        public readonly array $insurance,
        /** @var array<string, mixed>|null */
        public readonly ?array $activeDispute,
        public readonly ?int $activeChangesetId,
        public readonly int $vat,
        public readonly float $fullPriceWithVAT,
        public readonly int $insuranceCost,
        public readonly ?string $issueCode,
        public readonly ?int $offerTaskId,
        public readonly bool $hasPayout,
        public readonly int $serviceFeeCompensation,
        public readonly int $serviceFeeCompensationPercent,
        public readonly ?int $reportId,
        public readonly bool $shareCommission,
        public readonly int $sharedCommissionAmount,
        public readonly int $sharedCommissionAmountInWorkerCurrency,
        public readonly array $dataForIterable,
        public readonly array $worker,
        public readonly array $payer,
        /** @var list<array<string, mixed>> */
        public readonly array $files,
        /** @var list<array<string, mixed>> */
        public readonly array $links,
        public readonly ?string $agreementFileLink,
        public readonly int $messageCount,
        /** @var array<string, mixed>|null */
        public readonly ?array $group,
        public readonly bool $copyright,
        public readonly string $createType,
        public readonly array $currency,
        public readonly array $workerCurrency,
        public readonly array $customer,
        public readonly string $dateCreated,
        public readonly ?string $dateAccepted,
        public readonly string $dateEnd,
        public readonly ?string $dateFinished,
        public readonly ?string $datePaid,
        public readonly ?string $datePayAt,
        public readonly ?string $documentDate,
        public readonly bool $needReport,
        public readonly int $state,
        public readonly ?int $merchantId,
    ) {
    }
}
