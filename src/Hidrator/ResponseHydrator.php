<?php

namespace App\Hidrator;

use App\Domain\Inspector;
use App\Domain\Response\Answer\AnswerAttachment;
use App\Domain\Response\Answer\AnswerChoice;
use App\Domain\Response\Answer\AnswerField;
use App\Domain\Response\Answer\ControlAnswer;
use App\Domain\Response\InspectionResponse;
use App\Domain\Store;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\RouterInterface;

class ResponseHydrator
{

    public $basdeUrl = "";

    public function __construct(
        private LoggerInterface $logger,
        private RouterInterface $router,
        private string                   $jsonFilePath
    )
    {
        $this->logger->info('ResponseHydrator loading...');
    }


    public function hydrate(): InspectionResponse
    {
        $this->logger->info('Hydrating response...');
        $jsonData = file_get_contents($this->jsonFilePath);
        $data = json_decode($jsonData, true);
        $this->logger->info('json data loaded');

        return $this->createInspectionResponse($data);
    }

    private function createInspectionResponse(array $data): InspectionResponse
    {
        $this->logger->info('Creating InspectionResponse...');

        $inspector = new Inspector(
            $data['inspector']['id'],
            $data['inspector']['name']
        );
        $this->logger->info('Inspector created', ['inspector' => $inspector]);

        $store = new Store(
            $data['store']['id'],
            $data['store']['name']
        );
        $this->logger->info('Store created', ['store' => $store]);

        $answers = array_map(function($answerData) {
            $this->logger->info('Creating answer...', ['answer' => $answerData]);

            $field = new AnswerField(
                $answerData['field']['sort'],
                $answerData['field']['id'],
                $answerData['field']['ref'],
                $answerData['field']['type']
            );
            $this->logger->info('Field created', ['field' => $field]);

            $choices = isset($answerData['choices'])
                ? array_map(function($choiceData) {
                    $this->logger->info('Creating choice...', ['choice' => $choiceData]);
                    return new AnswerChoice($choiceData['label'], $choiceData['ref']);
                }, $answerData['choices'])
                : null;

            $this->logger->info('Choices created', ['choices' => $choices]);

            $choice = isset($answerData['choice'])
                ? new AnswerChoice($answerData['choice']['label'], $answerData['choice']['ref'])
                : null;

            $this->logger->info('Choice created', ['choice' => $choice]);

            # a public base url  get of symfony config
            $attachments = isset($answerData['attachments'])
                ? array_map(function($attachmentData) {
                    $this->logger->info('Creating attachment...', ['attachment' => $attachmentData]);

                    return new AnswerAttachment(
                        $attachmentData['url'] ?? $this->basdeUrl . '/'.  $attachmentData['filename'],
                        $attachmentData['type'],
                        $attachmentData['name'],
                        $attachmentData['size'] ?? 0
                    );
                }, $answerData['attachments'])
                : null;

            $this->logger->info('Attachments created', ['attachments' => $attachments]);


            return new ControlAnswer(
                $field,
                $answerData['type'],
                $choices,
                $choice,
                $answerData['boolean'] ?? null,
                $attachments
            );


        }, $data['answers']);

        $this->logger->info('Answers created', ['answers' => $answers]);

        # a now is a DateTime object
        $submissionDate = new \DateTime();

        return new InspectionResponse(
            $data['id'],
            $submissionDate,
            $inspector,
            $store,
            $answers,
        );
    }
}