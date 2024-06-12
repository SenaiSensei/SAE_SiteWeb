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
$webPage->appendMenu("<a href='admin/tvshow-form.php?tvShowId={$TVShowId}' class='menu_edit'>Éditer</a>");
$webPage->appendMenu("<a href='admin/tvshow-delete.php?tvShowId={$TVShowId}' class='menu_delete'>Supprimer</a>");
$webPage->appendCssUrl("css/season.css");
$webPage->appendToHead("<meta name='description' content='Author: V.D., An app web to view season shows on a database'>");

$webPage->appendContent("<section class='serie'>
    <img src='poster.php?posterId={$serie->getPosterId()}' alt='Poster'>
    <section class='serie_content'>
    <a class='title_serie'>{$serie->getName()}</a>
    <a class='origin_title_serie'>{$serie->getOriginalName()}</a>
    <a class='desc_title_serie'>{$serie->getOverview()}</a></section></section>
");

$stmt = CollectionSeason::findByTVShowId((int)$_GET['tvShowId']);

foreach ($stmt as $ligne) {
    $webPage->appendContent("<a class='season' href='episode.php?seasonId={$ligne->getId()}'>
    <img src='poster.php?posterId={$ligne->getPosterId()}' alt='Poster'>
    <section class='season_title'>{$ligne->getName()}</section>
</a>");
}


echo $webPage->toHTML();
