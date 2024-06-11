<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\TVShow;
use Html\AppWebPage;
use Entity\Collection\CollectionEpisode;
use Entity\Season;

$SeasonId = $_GET['seasonId'];
if (!empty($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
    $SeasonId = $_GET['seasonId'];
} else {
    header('Location: http://localhost:8000/index.php');
    exit;
}


try {
    $season = Season::findById((int)$SeasonId);
} catch (EntityNotFoundException $e) {
    http_response_code(404);
    exit;
}


try {
    $serie = TVShow::findById($season->getTvShowId());
} catch (EntityNotFoundException $e) {
    http_response_code(404);
    exit;
}

$titre = "Série TV: {$serie->getName()}";
$titreSeason = $season->getName();

$webPage = new AppWebPage($titre." ".$titreSeason);
$webPage->appendMenu("<section class='menu'><a href='index.php' class='menu_accueil'>Accueil</a>
</section>");
$webPage->appendCssUrl("css/episode.css");
$webPage->appendToHead("<meta name='description' content='Author: R.L., An app web to view and modify saves TV shows on a database'>");

$stmt = CollectionEpisode::findBySeasonId((int)$SeasonId);


$webPage->appendContent("<section class='season'>
    <img src='poster.php?posterId={$season->getPosterId()}' alt='Poster'>
    <section class='title'>
    <a class='title_serie' href='season.php?tvShowId={$season->getTvShowId()}'>{$serie->getName()}</a>
    <a class='title_saison'>{$season->getName()}</a>
    </section>
    </section>
");

foreach ($stmt as $ligne) {
    $webPage->appendContent("<section class='episodes'>
    <a class='num_title_ep'>{$webPage->escapeString((string)$ligne->getEpisodeNumber())} - {$webPage->escapeString((string)$ligne->getName())}</a>
    <a class='description_ep'>{$webPage->escapeString((string)$ligne->getOverview())}</a>
</section>");
}


echo $webPage->toHTML();
