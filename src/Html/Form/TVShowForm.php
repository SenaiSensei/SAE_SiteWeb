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
            <form action="$action" name="" method="post"></form>
            <label><input name="id" type="hidden" value="{$this?->getTvShow()?->getId()}"></label>
        HTML;
        if ($this->escapeString($this?->getTvShow()?->getName()) != null) {
            $form .= <<<HTML
            <label class="Nom"><input name="name" type="text" value="{$this->escapeString($this->getTvShow()?->getName())}" required></label>
        HTML;
        }

        if ($this->escapeString($this->getTvShow()?->getOriginalName()) != null) {
            $form .= <<<HTML
            <label class="NomOriginal"><input name="originalName" type="text" value="{$this->escapeString($this->getTvShow()?->getOriginalName())}" required></label>
        HTML;
        }

        $form .= <<<HTML
            <label class="homePage"><input name="homePage" type="text" value="{$this->escapeString($this->getTvShow()?->getHomePage())}"></label>
        HTML;

        if ($this->escapeString($this->getTvShow()?->getOverview()) != null) {
            $form .= <<<HTML
            <label class="Overview"><input name="overview" type="text" value="{$this->escapeString($this->getTvShow()?->getOverview())}" required></label>
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

        if (ctype_digit($_POST['id']) and isset($_POST['id'])) {
            $queryStringId = (int)$_POST['id'];
        } elseif ($_POST['id'] == null) {
            $queryStringId = null;
        }

        if (ctype_alpha($_POST['name']) and isset($_POST['name'])) {
            $queryStringName = $_POST['name'];
            $queryStringName->stripTagsAndTrim($queryStringName);
        } else {
            throw new ParameterException();
        }

        if (ctype_alpha($_POST['originalName']) and isset($_POST['originalName'])) {
            $queryStringOriginalName = $_POST['originalName'];
            $queryStringOriginalName->stripTagsAndTrim($queryStringOriginalName);
        } else {
            throw new ParameterException();
        }

        if (ctype_alpha($_POST['homePage'])) {
            $queryStringHomePage = $_POST['homePage'];
            $queryStringHomePage->stripTagsAndTrim($queryStringHomePage);
        } elseif ($_POST['homePage'] == null) {
            $queryStringHomePage = null;
        }

        if (ctype_alpha($_POST['overview']) and isset($_POST['overview'])) {
            $queryStringOverview = $_POST['overview'];
            $queryStringOverview->stripTagsAndTrim($queryStringOverview);
        } else {
            throw new ParameterException();
        }

        $tvShow = new TVShowForm();
        $tvShow = $tvShow->getTvShow()->create($queryStringId, $queryStringName, $queryStringOriginalName, $queryStringHomePage, $queryStringOverview);
        $this->tvShow = $tvShow;
    }
}
