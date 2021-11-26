<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use App\Common\Presentation\Action\AbstractAction;
use App\Frontoffice\Query\Query\DownloadResumeQuery;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSBundle\Query\QueryBusAwareInterface;
use Webmunkeez\CQRSBundle\Query\QueryBusAwareTrait;

#[Route(['en' => '/download-resume', 'fr' => '/telecharger-cv'], name: 'download_resume', methods: ['GET'])]
final class DownloadResumeAction extends AbstractAction implements QueryBusAwareInterface
{
    use QueryBusAwareTrait;

    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function __invoke(): Response
    {
        $query = (new DownloadResumeQuery())
        ->setEmployeeId(Uuid::fromString('ffe7d61f-f184-44a7-bce7-256e6cd8e7a3'))
        ->setLanguageId(Uuid::fromString('f0d0c1c9-a1f0-4057-a7f6-78e2673e4829'));

        /** @var array $result */
        $result = $this->queryBus->dispatch($query);

        $response = new BinaryFileResponse($this->params->get('upload_path').'/career/employee/resume-'.$result['employee']->getId().'.pdf');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $result['employee']->getFirstName().' '.$result['employee']->getLastName().'.pdf');

        return $response;
    }
}
