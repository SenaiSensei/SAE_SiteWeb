<?php

namespace Html;

class WebPage
{
    private string $head = "";
    private string $title;
    private string $body = "";

    /**
     * Constructeur
     *
     * @param string $title Titre de la page
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    /**
     * Retourne le contenu de $this->head.
     *
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Retourner le contenu de $this->title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Affecter le titre de la page.
     *
     * @param string $title Le titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Retourne le contenu de $this->body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Ajoute un contenu dans $this->head.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendToHead(string $content) : void
    {
        $this->head .= "$content";
    }

    /**
     * Ajoute un contenu CSS dans $this->head.
     *
     * @param string $css Le contenu CSS à ajouter
     */
    public function appendCss(string $css) : void
    {
        $this->appendToHead("<style>$css</style>");
    }

    /**
     * Ajoute l'URL d'un script CSS dans $this->head.
     *
     * @param string $url L'URL du script CSS
     */
    public function appendCssUrl(string $url) : void
    {
        $this->appendToHead('<link rel="stylesheet" href="'."$url".'">');
    }

    /**
     * Ajoute un contenu JavaScript dans $this->head.
     *
     * @param string $js Le contenu JavaScript à ajouter
     */
    public function appendJs(string $js) : void
    {
        $this->appendToHead("<script>$js</script>");
    }

    /**
     * Ajoute l'URL d'un script JavaScript dans $this->head.
     *
     * @param string $url L'URL du script JavaScript
     */
    public function appendJsUrl(string $url) : void
    {
        $this->appendToHead("<script src=\"$url\"></script>");
    }

    /**
     * Ajoute un contenu dans $this->body.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendContent(string $content) : void
    {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète.
     *
     * @return string La page Web
     */
    public function toHTML() : string
    {
        $head = $this->getHead();
        $title = $this->getTitle();
        $body = $this->getBody();
        $lastModif = WebPage::getLastModification();
        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">\n
            <head>
                $head
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>$title</title>
            </head>
            <body>
                $body
                <br>$lastModif
            </body>
        </html>
        HTML;
        return $html;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string La chaîne à protéger
     * @return string La chaîne protégée
     */
    public function escapeString(string $string): string
    {
        $chaine = htmlspecialchars($string,ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE);

        return $chaine;
    }

    /**
     * Donner la date et l'heure de la dernière modification du script principal.
     *
     * @return string
     */
    public static function getLastModification(): string
    {
        return "Dernière modification de cette page le ".date("d/m/Y à h:i:s",getlastmod());
    }
}