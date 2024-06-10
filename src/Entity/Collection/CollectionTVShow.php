<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TVShow;
use PDO;

class CollectionTVShow
{
    public static function findByTVShowId(): array
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id,name,originalName,homePage,overview,posterId
            FROM TVSHOW
            ORDER BY name;
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, TVShow::class);
    }

}