<?php
declare(strict_types=1);
use Entity\Poster;

try {
    if (isset($_GET['posterId'])) {
        if (!empty($_GET['posterId'])) {

            if (ctype_digit($_GET['posterId'])) {

                header('Content-Type: image/jpeg');
                echo Poster::findById((int)$_GET['posterId'])->getJpeg();

            } else {

                throw new ParameterException();

            }
        } else {

            throw new ParameterException();

        }
    } else {

        throw new ParameterException();

    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}