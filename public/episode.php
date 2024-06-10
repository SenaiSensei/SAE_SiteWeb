<?php

declare(strict_types=1);

use Entity\TVShow;
use Html\WebPage;
use Entity\Collection\CollectionEpisode;
use Entity\Season;

$SeasonId = (int)$_GET['seasonId'];
$season = Season::findById($SeasonId);
$serie = TVShow::findById($season->getTvShowId());

$titre = "Série TV: {$serie->getName()}";
$titreSeason = $season->getName();

$webPage = new WebPage($titre.' '.$titreSeason);
$webPage->appendContent("<h1>$titre<br>$titreSeason</h1>");

$stmt = CollectionEpisode::findBySeasonId($SeasonId);



$webPage->appendContent("<img src='default/default.png' alt='Poster'>
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


echo $webPage->toHTML();
