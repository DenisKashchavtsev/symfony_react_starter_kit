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
    private ?string $meta_title = null;

    #[Assert\Type(type: ['string', 'null'])]
    private ?string $meta_description = null;

    #[Assert\NotBlank]
    private bool $status;

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
        return $this->meta_title;
    }

    public function setMetaTitle(?string $meta_title): void
    {
        $this->meta_title = $meta_title;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(?string $meta_description): void
    {
        $this->meta_description = $meta_description;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}
