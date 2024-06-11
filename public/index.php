<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\CollectionTVShow;

$titre = "Série TV";
$webPage = new AppWebPage($titre);
$webPage->appendCssUrl("css/index.css");

$stmt = CollectionTVShow::findAll();

foreach ($stmt as $ligne) {
    $webPage->appendContent("<a class='serie' href='season.php/seasonId={$webPage->escapeString((string)$ligne->getId())}'>
    <img src='poster.php?posterId={$ligne->getPosterId()}' alt='Poster'>
    <section class='titre'>{$webPage->escapeString((string)$ligne->getName())}</section>
    <section class='description'>{$webPage->escapeString((string)$ligne->getOverview())}</section>
</a>");
}





echo $webPage->toHTML();
