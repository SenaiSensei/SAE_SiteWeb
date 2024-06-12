<?php
declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TVShow;
use Html\Form\TVShowForm;
use Html\WebPage;

try {
    if (!isset($_GET['tvShowId'])) {
        throw new ParameterException();
    } else {
        if (ctype_digit($_GET['tvShowId'])) {
            $tvShow = TVShow::findById((int)$_GET['tvShowId']);
            $tvShow->delete();
            header('Location: http://localhost:8000');
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