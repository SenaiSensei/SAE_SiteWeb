<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TVShow;
use Html\Form\TVShowForm;

try {
    $tvShowForm = new TVShowForm();
    $tvShowForm->setEntityFromQueryString();
    $tvShowForm->getTvShow()->save();
    header('Location: http://localhost:8000');
    exit;
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}