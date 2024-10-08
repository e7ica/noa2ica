<?php
namespace App\Controller\Api;

use App\Service\AttachmentManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class AttachmentApiController extends AbstractController
{
    public function __construct(
        private AttachmentManager $attachmentManager,
        private LoggerInterface $logger,
        private RequestStack $requestStack
    ) {}

    #[Route('/inspection/{inspection_id}/form/step/{step}/attach', name: 'inspection_form_step_attach', requirements: [
        'inspection_id' => '\d+',
        'step' => '\d+'
    ], methods: ['POST'])]
    public function attach_file(Request $request, int $inspection_id, int $step): Response
    {
        $this->logger->info('Petición de adjuntar archivo recibida.',
            ['inspection_id' => $inspection_id, 'step' => $step]
        );

        $file = $request->files->get('attachment');
        if (!$file) {
            return $this->json([
                'status' => 'error',
                'message' => 'No se recibió ningún archivo.',
            ], 400);
        }

        $result = $this->attachmentManager->handleFileUpload($file, $inspection_id, $step);

        if ($result['status'] === 'success') {
            $request = $this->requestStack->getCurrentRequest();
            $basePath = $request->getSchemeAndHttpHost() . $request->getBasePath();
            $fileUrl = $basePath . '/' . $result['relative_path'];

            return $this->json([
                'status' => 'success',
                'filename' => $result['filename'],
                'url' => $fileUrl,
                'path' => $result['relative_path'],
            ], 200);
        }

        return $this->json($result, 500);
    }
}
