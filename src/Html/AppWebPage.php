<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    private string $menu;
    public function __construct(string $title = '')
    {
        parent::__construct($title);
        $this->appendCssUrl('/css/style.css');
    }

    public function appendMenu(string $menu)
    {
        $this->menu = $menu;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function toHTML(): string
    {

        $head = $this->getHead();
        $title = $this->getTitle();
        $body = $this->getBody();
        $lastModif = WebPage::getLastModification();
        $menu = $this->getMenu();
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
            <section class="menu">$menu</section>
            <section class="header"><h1>$title</h1></section>
                <section class="content">$body</section>
            </body>
            <footer><a class="footer">$lastModif</a></footer>
        </html>
        HTML;
        return $html;
    }
}
