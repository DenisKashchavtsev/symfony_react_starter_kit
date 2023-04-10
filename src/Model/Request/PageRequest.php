<?php

namespace App\Model\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PageRequest
{
    #[Assert\NotBlank]
    private string $name;

    #[Assert\Type(type: ['string', 'null'])]
    private ?string $content = null;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    private string $url;

    #[Assert\Type(type: ['string', 'null'])]
    private ?string $metaTitle = null;

    #[Assert\Type(type: ['string', 'null'])]
    private ?string $metaDescription = null;

    #[Assert\Type(type: ['string', 'bool'])]
    private bool $status = true;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool|string $status): void
    {
        if (is_string($status)) {
            $this->status = '1' === $status;
        } else {
            $this->status = $status;
        }
    }
}
