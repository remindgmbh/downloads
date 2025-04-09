<?php

declare(strict_types=1);

namespace Remind\Downloads\Domain\Model;

use Remind\Extbase\Domain\Model\AbstractJsonSerializableEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Download extends AbstractJsonSerializableEntity
{
    protected string $name = '';

    protected ?FileReference $thumbnail = null;

    protected ?FileReference $file = null;

    /**
     * @var ObjectStorage<\Remind\Downloads\Domain\Model\Group> $groups
     */
    protected ObjectStorage $groups;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getThumbnail(): ?FileReference
    {
        return $this->thumbnail;
    }

    public function setThumbnail(FileReference $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getFile(): ?FileReference
    {
        return $this->file;
    }

    public function setFile(FileReference $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function addGroup(Group $group): void
    {
        $this->groups->attach($group);
    }

    public function removeGroup(Group $group): void
    {
        $this->groups->detach($group);
    }

    /**
     * @return ObjectStorage<Group>
     */
    public function getGroups(): ObjectStorage
    {
        return $this->groups;
    }

    /**
     * @param ObjectStorage<Group> $groups
     */
    public function setGroups(ObjectStorage $groups): self
    {
        $this->groups = $groups;

        return $this;
    }
}
