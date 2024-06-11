<?php

declare(strict_types=1);

use Entity\Collection\CollectionSeason;
use Entity\Season;
use Entity\TVShow;
use Html\AppWebPage;

$TVShowId = (int)$_GET['tvShowId'];
$serie = TVShow::findById($TVShowId);

$title = "Série TV: {$serie->getName()}";

$webPage = new AppWebPage($title);
$webPage->appendContent("<h1>$title</h1>");


$webPage->appendContent("<img src='default/default.png' alt='Poster'>
    <a class='title_serie'>{$serie->getName()}</a>
    <a class='origin_title_serie'>{$serie->getOriginalName()}</a>
    <a class='origin_title_serie'>{$serie->getOverview()}</a>
");

$stmt = CollectionSeason::findByTVShowId($TVShowId);
foreach ($stmt as $ligne) {
    $webPage->appendContent("<section class='season'>
    <img src='default/default.png' alt='Poster'>
    <a class='season_title'>{$ligne->getName()}</a>
</section>");
}


echo $webPage->toHTML();