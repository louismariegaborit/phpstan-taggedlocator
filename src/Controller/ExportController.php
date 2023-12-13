<?php

namespace App\Controller;

use App\Exporter\ExporterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Argument\ServiceLocator;
use Symfony\Component\DependencyInjection\Attribute\TaggedLocator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    public function __construct(
        #[TaggedLocator(ExporterInterface::class, defaultIndexMethod: 'getFormat')]
        private ServiceLocator $exporters,
    ) {
    }

    #[Route("/export/{format}")]
    public function export(string $format): Response
    {
        if (!$this->exporters->has($format)) {
            throw new NotFoundHttpException('Format not supported.');
        }

        $exporter = $this->exporters->get($format);

        return new Response($exporter->export());
    }
}