<?php

declare(strict_types=1);

namespace Remind\Downloads\Controller;

use Psr\Http\Message\ResponseInterface;
use Remind\Downloads\Domain\Repository\DownloadRepository;
use Remind\Downloads\Domain\Repository\GroupRepository;
use Remind\Extbase\Service\SerializationService;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class DownloadController extends ActionController
{
    protected ContentObjectRenderer $contentObjectRenderer;

    public function __construct(
        private readonly DownloadRepository $downloadRepository,
        private readonly FlexFormService $flexFormService,
        private readonly GroupRepository $groupRepository,
        private readonly SerializationService $serializationService,
    ) {
    }

    public function selectionListAction(): ResponseInterface
    {
        $recordUids = $this->getRecordUidsFromFlexFormSettings();

        $records = array_map(function ($recordUid) {
            $entity = $this->downloadRepository->findByUid((int) $recordUid);
            $record = $this->seriliazeDownloadRecord($entity);

            return $record;
        }, $recordUids);

        return $this->processJsonResponse($records);
    }

    public function groupSelectionListAction(): ResponseInterface
    {
        $recordUids = $this->getRecordUidsFromFlexFormSettings();

        $records = array_map(function ($recordUid) {
            $record = $this->serializeRecord(
                $this->groupRepository->findByUid((int) $recordUid),
            );

            $downloadsSerialized = [];
            foreach (($record['downloads'] ?? []) as $download) {
                $downloadsSerialized[] = $this->seriliazeDownloadRecord($download);
            }
            $record['downloads'] = $downloadsSerialized;

            return $record;
        }, $recordUids);

        return $this->processJsonResponse($records);
    }

    /**
     * @return array<mixed>
     */
    protected function getRecordUidsFromFlexFormSettings(string $recordsFieldName = 'records'): array
    {
        /** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject */
        $contentObject = $this->request->getAttribute('currentContentObject');

        $flexFormContent = $this->flexFormService->convertFlexFormContentToArray(
            $contentObject->data['pi_flexform'] ?? ''
        );

        return explode(',', $flexFormContent[$recordsFieldName] ?? '');
    }

    /**
     * @return array<mixed>
     */
    protected function seriliazeDownloadRecord(mixed $record): ?array
    {
        $properties = array_keys($record->_getProperties());
        $properties[] = 'fileSize';
        return $this->serializeRecord($record, $properties);
    }

    /**
     * @return array<mixed>
     */
    protected function serializeRecord(mixed $record, ?array $properties = null): ?array
    {
        $properties ??= array_keys($record->_getProperties());
        return $this->serializationService->serializeBaseProperties($record, $properties);
    }

    protected function processJsonResponse(?array $records): ResponseInterface
    {
        $json = json_encode(array_filter($records));
        return $this->jsonResponse($json !== false ? $json : null);
    }
}
