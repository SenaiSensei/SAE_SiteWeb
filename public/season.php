<?php

declare(strict_types=1);

use Entity\Collection\CollectionSeason;
use Entity\Exception\EntityNotFoundException;
use Entity\TVShow;
use Html\AppWebPage;

$TVShowId = (int)$_GET['tvShowId'];
if (!empty($_GET['tvShowId']) && ctype_digit($_GET['tvShowId'])) {
    $TVShowId = (int)$_GET['tvShowId'];
} else {
    header('Location: http://localhost:8000/index.php');
    exit;
}

try {
    $serie = TVShow::findById($TVShowId);
} catch (EntityNotFoundException $e) {
    http_response_code(404);
    exit;
}

$title = "Série TV: {$serie->getName()}";

$webPage = new AppWebPage($title);
$webPage->appendMenu("<a href='index.php?genre=0' class='menu_accueil'>Accueil</a>");


$webPage->appendContent("<img src='poster.php?posterId={$serie->getPosterId()}' alt='Poster'>
    <a class='title_serie'>{$serie->getName()}</a>
    <a class='origin_title_serie'>{$serie->getOriginalName()}</a>
    <a class='desc_title_serie'>{$serie->getOverview()}</a>
");

$stmt = CollectionSeason::findByTVShowId((int)$_GET['tvShowId']);
foreach ($stmt as $ligne) {
    $webPage->appendContent("<section class='season'>
    <img src='poster.php?posterId={$ligne->getPosterId()}' alt='Poster'>
    <a class='season_title' href='episode.php?seasonId={$ligne->getId()}'>{$ligne->getName()}</a>
</section>");
}


echo $webPage->toHTML();
