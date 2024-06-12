<?php
declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TVShow;
use Html\Form\TVShowForm;
use Html\AppWebPage;

try {
    if (!isset($_GET['tvShowId'])) {
        $tvShow = null;
        $webPage = new AppWebPage("Formulaire de création");
        $form = new TVShowForm($tvShow);
        $webPage->AppendMenu("<a href='http://localhost:8000' class='menu_accueil'>Accueil</a>");
        $webPage->appendContent($form->getHtmlForm("tvshow-save.php"));
        $webPage->appendCssUrl("../css/form.css");
        echo $webPage->toHTML();
    } else {
        if (ctype_digit($_GET['tvShowId'])) {
            $tvShow = TVShow::findById((int)$_GET['tvShowId']);
            $webPage = new AppWebPage("Formulaire d'édition");
            $form = new TVShowForm($tvShow);
            $webPage->AppendMenu("<a href='http://localhost:8000' class='menu_accueil'>Accueil</a>");
            $webPage->appendContent($form->getHtmlForm("tvshow-save.php"));
            echo $webPage->toHTML();
        } else {
            throw new ParameterException();
        }
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}