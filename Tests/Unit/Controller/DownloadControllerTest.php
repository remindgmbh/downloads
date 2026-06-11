<?php

declare(strict_types=1);

namespace Remind\Downloads\Tests\Unit\Controller;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;
use Remind\Downloads\Controller\DownloadController;
use Remind\Downloads\Domain\Model\Download;
use Remind\Downloads\Domain\Repository\DownloadRepository;
use Remind\Downloads\Domain\Repository\GroupRepository;
use Remind\Extbase\Service\SerializationService;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

#[CoversClass(DownloadController::class)]
class DownloadControllerTest extends UnitTestCase
{
    private DownloadRepository&MockObject $downloadRepository;

    private GroupRepository&MockObject $groupRepository;

    private FlexFormService&MockObject $flexFormService;

    private SerializationService&MockObject $serializationService;

    private DownloadController $downloadController;

    public function setUp(): void
    {
        parent::setUp();

        $this->downloadRepository = $this->createMock(DownloadRepository::class);
        $this->groupRepository = $this->createMock(GroupRepository::class);
        $this->flexFormService = $this->createMock(FlexFormService::class);
        $this->serializationService = $this->createMock(SerializationService::class);

        $this->downloadController = new DownloadController(
            $this->downloadRepository,
            $this->flexFormService,
            $this->groupRepository,
            $this->serializationService,
        );
    }

    #[Test]
    public function downloadsAreSerializedCorrectly(): void
    {
        $download = $this->createDownloadMock(1, 'Test Download');

        $this->serializationService
            ->expects(self::once())
            ->method('serializeBaseProperties')
            ->with($download, self::anything())
            ->willReturn(['uid' => 1, 'name' => 'Test Download']);

        $method = new ReflectionMethod(DownloadController::class, 'serializeDownloadRecord');
        $result = $method->invoke($this->downloadController, $download);

        self::assertIsArray($result);
        self::assertArrayHasKey('uid', $result);
        self::assertSame(1, $result['uid']);
        self::assertSame('Test Download', $result['name']);
    }

    /**
     * Helper method to create a Download mock
     */
    protected function createDownloadMock(int $uid, string $name): Download
    {
        $download = $this->createMock(Download::class);
        $download->method('getUid')->willReturn($uid);
        $download->method('getName')->willReturn($name);
        $download->method('_getProperties')->willReturn([
            'file' => null,
            'name' => $name,
            'uid' => $uid,
        ]);
        return $download;
    }
}
