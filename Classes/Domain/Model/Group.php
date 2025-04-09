<?php

declare(strict_types=1);

namespace Remind\Downloads\Domain\Model;

use Remind\Extbase\Domain\Model\AbstractJsonSerializableEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Group extends AbstractJsonSerializableEntity
{
    protected string $name = '';

    protected string $description = '';

    /**
     * @var ObjectStorage<Download> $downloads
     */
    protected ObjectStorage $downloads;

    protected ?FileReference $image = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function addDownload(Download $download): void
    {
        $this->downloads->attach($download);
    }

    public function removeDownload(Download $download): void
    {
        $this->downloads->detach($download);
    }

    /**
     * @return ObjectStorage<Download>
     */
    public function getDownloads(): ObjectStorage
    {
        return $this->downloads;
    }

    /**
     * @param ObjectStorage<Download> $downloads
     */
    public function setDownloads(ObjectStorage $downloads): self
    {
        $this->downloads = $downloads;

        return $this;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function setImage(FileReference $image): self
    {
        $this->image = $image;

        return $this;
    }
}
