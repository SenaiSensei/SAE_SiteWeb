<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\CollectionTVShow;

$titre = "Série TV";
$webPage = new AppWebPage($titre);
$webPage->appendCssUrl("css/index.css");
$webPage->appendToHead("<meta name='description' content='Author: R.L., An app web to view and modify saves TV shows on a database'>");

$webPage->appendToHead("<section class='menu'><a href='index.php' class='menu_accueil'>Accueil</a>
<form action='filtre.php' method='GET' class='filtre'>
<p>Filtre</p>
<section class='value_filtre'>");

$stmt = CollectionTVShow::findAll();

foreach ($stmt as $ligne) {
    $webPage->appendToHead("
    <label><input name='id' type='radio' value='1'>1</label>");
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
