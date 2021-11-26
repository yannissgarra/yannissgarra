<?php

declare(strict_types=1);

namespace App\Frontoffice\Query\Query;

use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSBundle\Query\QueryInterface;

final class AboutQuery implements QueryInterface
{
    private Uuid $employeeId;
    private Uuid $languageId;

    public function getEmployeeId(): Uuid
    {
        return $this->employeeId;
    }

    public function setEmployeeId(Uuid $employeeId): self
    {
        $this->employeeId = $employeeId;

        return $this;
    }

    public function getLanguageId(): Uuid
    {
        return $this->languageId;
    }

    public function setLanguageId(Uuid $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }
}
