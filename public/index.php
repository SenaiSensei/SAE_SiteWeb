<?php

declare(strict_types=1);

use Entity\Collection\CollectionGenre;
use Html\AppWebPage;
use Entity\Collection\CollectionTVShow;
use Entity\Genre;

$titre = "Série TV";
$webPage = new AppWebPage($titre);
$webPage->appendCssUrl("css/index.css");
$webPage->appendToHead("<meta name='description' content='Author: R.L., An app web to view and modify saves TV shows on a database'>");

$webPage->appendMenu("<a href='index.php' class='menu_accueil'>Accueil</a>");


$genres = CollectionGenre::findAll();

$stmt = CollectionTVShow::findAll();

foreach ($stmt as $ligne) {
    $webPage->appendContent("<a class='serie' href='season.php/seasonId={$webPage->escapeString((string)$ligne->getId())}'>
    <img src='poster.php?posterId={$ligne->getPosterId()}' alt='Poster'>
    <section> <section class='titre'>{$webPage->escapeString((string)$ligne->getName())}</section>
    <section class='description'>{$webPage->escapeString((string)$ligne->getOverview())}</section></section>
</a>");
}





echo $webPage->toHTML();
