<?php

declare(strict_types=1);
use Html\WebPage;

$webpage = new WebPage();

$titre = "Série TV: ";

$webPage = new WebPage($titre);

$webPage->appendContent("<h1>$titre</h1>");


$webPage->appendContent("<a class='serie'>
    <img src='default/default.png' alt='Poster'>
    <a class='titre_serie'>Titre série</a>
    <a class='titre_saison'>Titre saison</a>
    <a class='num_ep'>Numéro episode 1</a>
    <a class='titre_ep'>Titre episode 1</a>
    <a class='description_ep'>Description episode 1</a>
</a>");


echo $webpage->toHTML();
