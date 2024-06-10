<?php

declare(strict_types=1);

use Html\WebPage;
use Entity\Collection\CollectionTVShow;

$titre = "Série TV";
$webPage = new WebPage($titre);
$webPage->appendContent("<h1>$titre</h1>");

$stmt = CollectionTVShow::findAll();

foreach ($stmt as $ligne) {
    $webPage->appendContent("<a class='serie' href='season.php/seasonId={$webPage->escapeString((string)$ligne->getId())}'>
    <img src='default/default.png' alt='Poster'>
    <a class='titre'>{$webPage->escapeString((string)$ligne->getName())}</a>
    <a class='description'>{$webPage->escapeString((string)$ligne->getOverview())}</a>
</a>");
}





echo $webPage->toHTML();
