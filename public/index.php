<?php

declare(strict_types=1);

use Entity\Collection\CollectionGenre;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;
use Entity\Collection\CollectionTVShow;

if (!isset($_GET['genre'])) {
    header('Location: http://localhost:8000/index.php?genre=0');
}

$titre = "Série TV";
$webPage = new AppWebPage($titre);
$webPage->appendCssUrl("css/index.css");
$webPage->appendToHead("<meta name='description' content='Author: R.L., An app web to view and modify saves TV shows on a database'>");

$webPage->appendMenu("<a href='index.php?genre=0' class='menu_accueil'>Accueil</a>");
$webPage->appendFiltre("<form action='index.php' method='get' class='filter'><label class='filter_title'>Filtre :</label><label><input type='radio' name='genre' value='0'>Aucun</label></label>");
$genres = CollectionGenre::findAll();

foreach ($genres as $ligne) {
    $webPage->appendFiltre("<label><input type='radio' name='genre' value='{$ligne->getId()}'>{$ligne->getName()}</label>");
}


$webPage->appendFiltre("<button type='submit'>Search</button></label></form>");

if (!ctype_digit($_GET['genre'])) {
    header('Location: http://localhost:8000/index.php?genre=0');
}

if ($_GET['genre'] == 0) {
    $stmt = CollectionTVShow::findAll();

    foreach ($stmt as $ligne) {
        $webPage->appendContent("<a class='serie' href='season.php?tvShowId={$webPage->escapeString((string)$ligne->getId())}'>
        <img src='poster.php?posterId={$ligne->getPosterId()}' alt='Poster'>
        <section> <section class='titre'>{$webPage->escapeString((string)$ligne->getName())}</section>
        <section class='description'>{$webPage->escapeString((string)$ligne->getOverview())}</section></section>
    </a>");
    }
} else {
    $stmt = CollectionTVShow::findByGenreId((int)$_GET['genre']);

    foreach ($stmt as $ligne) {
        $webPage->appendContent("<a class='serie' href='season.php?tvShowId={$webPage->escapeString((string)$ligne->getId())}'>
        <img src='poster.php?posterId={$ligne->getPosterId()}' alt='Poster'>
        <section> <section class='titre'>{$webPage->escapeString((string)$ligne->getName())}</section>
        <section class='description'>{$webPage->escapeString((string)$ligne->getOverview())}</section></section>
        </a>");
    }
}





echo $webPage->toHTML();
