<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param ?string $string La chaîne à protéger
     * @return string La chaîne protégée
     */
    public function escapeString(?string $text): string
    {
        $chaine = htmlspecialchars($text, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE);

        return $chaine;
    }

    public function stripTagsAndTrim(?string $text): string
    {
        if ($text == null) {
            $textStrip = "";
        } else {
            $textStrip = strip_tags($text);
            $textStrip = trim($textStrip);
        }
        return $textStrip;

    }
}
