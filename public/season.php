<?php

declare(strict_types=1);
use Html\WebPage;

$webPage = new WebPage();

$titre = "Série TV: ";

$webPage = new WebPage($titre);

$webPage->appendContent("<h1>$titre</h1>");


$webPage->appendContent("<section class='season'>
    <img src='default/default.png' alt='Poster'>
    <a class='title_serie'>Titre série</a>
    <a class='origin_title_serie'>Titre original de la série</a>
    <img src='default/default.png' alt='Poster'>
    <a class='season_title'>Titre saison 1</a>
</section>");


echo $webPage->toHTML();