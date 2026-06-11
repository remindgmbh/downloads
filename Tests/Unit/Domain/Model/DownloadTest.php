<?php

declare(strict_types=1);

namespace Remind\Downloads\Tests\Unit\Domain\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Remind\Downloads\Domain\Model\Download;
use TYPO3\CMS\Core\Resource\FileReference as CoreFileReference;
use TYPO3\CMS\Extbase\Domain\Model\FileReference as ExtbaseFileReference;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

#[CoversClass(Download::class)]
class DownloadTest extends UnitTestCase
{
    protected Download $download;

    public function setUp(): void
    {
        parent::setUp();

        $this->download = new Download();
    }

    #[Test]
    public function fileSizeCanBeRetrieved(): void
    {
        $extbaseFileReferenceMock = $this->getMockBuilder(ExtbaseFileReference::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getOriginalResource'])
            ->getMock();

        $coreFileReferenceMock = $this->getMockBuilder(CoreFileReference::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getSize'])
            ->getMock();

        $coreFileReferenceMock
            ->method('getSize')
            ->willReturn(12345);

        $extbaseFileReferenceMock
            ->method('getOriginalResource')
            ->willReturn($coreFileReferenceMock);

        $this->download->setFile($extbaseFileReferenceMock);

        self::assertSame(12345, $this->download->getFileSize());
    }

    #[Test]
    public function fileSizeReturnsZeroWhenFileIsNull(): void
    {
        self::assertSame(0, $this->download->getFileSize());
    }
}
