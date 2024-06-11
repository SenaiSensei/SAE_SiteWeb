<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use Entity\TVShow;
use PDO;

class CollectionTVShow
{
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id,name,originalName,homePage,overview,posterId
            FROM tvshow
            ORDER BY name;
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, TVShow::class);
    }

    public static function findByGenreId(int $id): array
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id,name,originalName,homePage,overview,posterId
            FROM tvshow
            WHERE id in (SELECT tvShowId
                         FROM tvshow_genre
                         WHERE genreId = ?);
        ');

        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, TVShow::class);
    }

}