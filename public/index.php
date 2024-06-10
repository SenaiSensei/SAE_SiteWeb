<?php

declare(strict_types=1);

use Html\WebPage;

$titre = "Série TV";
$webPage = new WebPage($titre);
$webPage->appendContent("<h1>$titre</h1>");

$webPage->appendContent("<a class='serie'>
    <img src='default/default.png' alt='Poster'>
    <a class='titre'>Titre série</a>
    <a class='description'>Description série</a>
</a>");



echo $webPage->toHTML();
