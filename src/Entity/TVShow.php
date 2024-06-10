<?php
declare(strict_types=1);

namespace Entity;

class TVShow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homePage;
    private string $overview;
    private int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TVShow
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TVShow
    {
        $this->name = $name;
        return $this;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): TVShow
    {
        $this->originalName = $originalName;
        return $this;
    }

    public function getHomePage(): string
    {
        return $this->homePage;
    }

    public function setHomePage(string $homePage): TVShow
    {
        $this->homePage = $homePage;
        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): TVShow
    {
        $this->overview = $overview;
        return $this;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public function setPosterId(int $posterId): TVShow
    {
        $this->posterId = $posterId;
        return $this;
    }


}