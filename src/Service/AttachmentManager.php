<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AttachmentManager
{
    public function __construct(
        private LoggerInterface $logger,
        private SluggerInterface $slugger,
        private string $attachmentsPath,
        private string $attachmentsDirectory
    ) {}

    public function handleFileUpload(UploadedFile $file, int $inspection_id, int $step): array
    {
        $newFilename = $this->generateUniqueFilename($file);
        $targetDirectory = $this->getTargetDirectory($inspection_id, $step);
        $absolutePath = $targetDirectory . '/' . $newFilename;
        $relativePath = str_replace($this->attachmentsDirectory, $this->attachmentsPath, $absolutePath);

        try {
            $this->createDirectoryIfNotExists($targetDirectory);
            $this->moveFile($file, $targetDirectory, $newFilename);

            return [
                'status' => 'success',
                'filename' => $newFilename,
                'relative_path' => $relativePath,
                'absolute_path' => $absolutePath,
            ];
        } catch (FileException $e) {
            $this->logger->error('Error al adjuntar archivo: '.$e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Hubo un problema al subir el archivo.',
            ];
        }
    }

    private function generateUniqueFilename(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);

        return $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
    }

    private function getTargetDirectory(int $inspection_id, int $step): string
    {
        $todayDate = (new \DateTime())->format('Y-m-d');

        return sprintf(
            '%s/%s/inspection_%d/step_%d',
            $this->attachmentsDirectory,
            $todayDate,
            $inspection_id,
            $step
        );
    }

    private function createDirectoryIfNotExists(string $directory): void
    {
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
            $this->logger->info('Carpeta creada: '.$directory);
        }
    }

    private function moveFile(UploadedFile $file, string $targetDirectory, string $newFilename): void
    {
        $file->move($targetDirectory, $newFilename);
        $this->logger->info('Archivo adjuntado exitosamente: '.$newFilename);
    }
}
