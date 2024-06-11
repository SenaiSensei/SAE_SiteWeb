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

$webPage->appendToHead("<section class='menu'><a href='index.php' class='menu_accueil'>Accueil</a>
<form action='index.php' method='POST' class='filtre'>
<p>Filtre</p>
<label><input name='id' type='radio' value='0' checked>Aucun</label>
<section class='value_filtre'>");



$genres = CollectionGenre::findAll();

foreach ($genres as $ligne) {
    $webPage->appendToHead("
    <label><input name='id' type='radio' value='{$ligne->getId()}'>{$ligne->getName()}</label>");
}


if ($_POST[''] == 0) {
    $stmt = CollectionTVShow::findAll();
}

$webPage->appendToHead("</section></form> </section>");

foreach ($stmt as $ligne) {
    $webPage->appendContent("<a class='serie' href='season.php/seasonId={$webPage->escapeString((string)$ligne->getId())}'>
    <img src='poster.php?posterId={$ligne->getPosterId()}' alt='Poster'>
    <section> <section class='titre'>{$webPage->escapeString((string)$ligne->getName())}</section>
    <section class='description'>{$webPage->escapeString((string)$ligne->getOverview())}</section></section>
</a>");
}





echo $webPage->toHTML();
