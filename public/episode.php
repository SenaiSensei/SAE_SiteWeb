<?php

declare(strict_types=1);

use Entity\TVShow;
use Html\WebPage;
use Entity\Collection\CollectionEpisode;
use Entity\Season;

$webpage = new WebPage();
$SeasonId = (int)$_GET['seasonId'];

$titre = "Série TV: {}";

$webPage = new WebPage($titre);
$webPage->appendContent("<h1>$titre</h1>");

$stmt = CollectionEpisode::findBySeasonId($SeasonId);

$season = Season::findById($SeasonId);
$serie = TVShow::findById($season->getTvShowId());

$webpage->appendContent("<img src='default/default.png' alt='Poster'>
    <a class='titre_serie' href='season.php?tvShowId={$season->getTvShowId()}'>{$serie->getName()}</a>
    <a class='titre_saison'>{$season->getName()}</a>
");

foreach ($stmt as $ligne) {
    $webPage->appendContent("<a class='episodes'>
    <a class='num_ep'>{$webPage->escapeString((string)$ligne->getEpisodeNumber())}</a>
    <a class='titre_ep'>{$webPage->escapeString((string)$ligne->getName())}</a>
    <a class='description_ep'>{$webPage->escapeString((string)$ligne->getOverview())}</a>
</a>");
}


echo $webpage->toHTML();
