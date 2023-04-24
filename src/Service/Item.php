<?php

namespace App\Service;

class Item
{
    public function __construct(
        private ?string    $name = null,
        private ?string    $content = null,
        private ?\DateTime $createdAt = null,
    )
    {
        $this->name = $name;
        $this->content = $content;
        $this->createdAt = $createdAt;


    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }



    public function isItemContentIsLesserThan1000Characters(): bool
    {
        if (strlen($this->content) > 1000) {
            return false;
        }
        return true;
    }

    public function isItemAdded30minutesAgo(): bool
    {
        $now = new \DateTime();
        $interval = $now->diff($this->createdAt);
        if ($interval->format('%i') > 30) {
            return false;
        }
        return true;
    }
}
