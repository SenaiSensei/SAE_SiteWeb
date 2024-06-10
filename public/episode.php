<?php

declare(strict_types=1);
use Html\WebPage;
use Entity\Collection\CollectionEpisode;

$webpage = new WebPage();
$SeasonId = (int)$_GET['seasonId'];

$titre = "Série TV: ";

$webPage = new WebPage($titre);
$webPage->appendContent("<h1>$titre</h1>");

$stmt = CollectionEpisode::findBySeasonId($SeasonId);

$webpage->appendContent("<img src='default/default.png' alt='Poster'>
    <a class='titre_serie'>{$_GET['name']}</a>
    <a class='titre_saison'>Titre saison</a>
");

foreach ($stmt as $ligne) {
    $webPage->appendContent("<a class='serie'>
    <a class='num_ep'>Numéro episode 1</a>
    <a class='titre_ep'>Titre episode 1</a>
    <a class='description_ep'>Description episode 1</a>
</a>");
}


echo $webpage->toHTML();
