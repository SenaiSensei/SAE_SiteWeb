<?php
declare(strict_types=1);

namespace Html\Form;

use Entity\TVShow;

class TVShowForm
{
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

}