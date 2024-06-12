<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Exception\ParameterException;
use Entity\TVShow;
use Html\StringEscaper;

class TVShowForm
{
    use StringEscaper;

    private ?TVShow $tvShow;

    /**
     * @param TVShow|null $tvShow
     */
    public function __construct(?TVShow $tvShow = null)
    {
        $this->tvShow = $tvShow;
    }

    public function getTvShow(): ?TVShow
    {
        return $this->tvShow;
    }

    public function getHtmlForm(string $action): string
    {
        $form = <<<HTML
            <form action="$action" method="post">
            <label><input name="id" type="hidden" value="{$this?->getTvShow()?->getId()}"></label>
        HTML;
        if ($this?->getTvShow()?->getName() != null) {
            $form .= <<<HTML
            <label class="Nom">Name : <input name="name" type="text" value="{$this->escapeString($this->getTvShow()?->getName())}" required></label>
        HTML;
        } else {
            $form .= <<<HTML
            <label class="Nom">Name : <input name="name" type="text" value="" required></label>
            HTML;
        }

        if ($this->getTvShow()?->getOriginalName() != null) {
            $form .= <<<HTML
            <label class="NomOriginal">Original Name : <input name="originalName" type="text" value="{$this->escapeString($this->getTvShow()?->getOriginalName())}" required></label>
        HTML;
        } else {
            $form .= <<<HTML
            <label class="NomOriginal">Original Name : <input name="originalName" type="text" value="" required></label>
            HTML;
        }

        if ($this->getTvShow()?->getHomePage() != null) {
            $form .= <<<HTML
            <label class="homePage">HomePage : <input name="homePage" type="text" value="{$this->escapeString($this->getTvShow()?->getHomePage())}" required></label>
        HTML;
        } else {
            $form .= <<<HTML
            <label class="homePage">HomePage : <input name="homePage" type="text" value="" required></label>
            HTML;
        }

        if ($this->getTvShow()?->getOverview() != null) {
            $form .= <<<HTML
            <label class="Overview">Overview : <input name="overview" type="text" value="{$this->escapeString($this->getTvShow()?->getOverview())}" required></label>
        HTML;
        } else {
            $form .= <<<HTML
            <label class="Overview">Overview : <input name="overview" type="text" value="" required></label>
            HTML;
        }
        
        $form .= <<<HTML
            <button type="submit">Save</button
            </form>
        HTML;

        return $form;
    }

    public function setEntityFromQueryString(): void
    {

        if (isset($_POST['id']) and ctype_digit($_POST['id'])) {
            $queryStringId = (int)$_POST['id'];
        } else  {
            $queryStringId = null;
        }

        if (isset($_POST['name'])) {
            $queryStringName = $_POST['name'];
            $queryStringName = $this->stripTagsAndTrim($queryStringName);
        } else {
            throw new ParameterException();
        }

        if (isset($_POST['originalName'])) {
            $queryStringOriginalName = $_POST['originalName'];
            $queryStringOriginalName = $this->stripTagsAndTrim($queryStringOriginalName);
        } else {
            throw new ParameterException();
        }

        if (isset($_POST['homePage'])) {
            $queryStringHomePage = $_POST['homePage'];
            $queryStringHomePage = $this->stripTagsAndTrim($queryStringHomePage);
        } else {
            throw new ParameterException();
        }

        if (isset($_POST['overview'])) {
            $queryStringOverview = $_POST['overview'];
            $queryStringOverview = $this->stripTagsAndTrim($queryStringOverview);
        } else {
            throw new ParameterException();
        }

        $tvShow = new TVShowForm();
        $tvShow = TVShow::create($queryStringName, $queryStringOriginalName, $queryStringHomePage,$queryStringOverview,$queryStringId);
        $this->tvShow = $tvShow;
    }
}
