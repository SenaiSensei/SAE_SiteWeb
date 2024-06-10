<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use PDO;

class CollectionSeason
{
    public static function findBySeasonId(int $TVShowId): array
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id,tvShowId,name,seasonNumber,posterId
            FROM SEASON
            WHERE tvShowId = ?
            ORDER BY seasonNumber;
        ');

        $stmt->execute([$TVShowId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Season::class);
    }

}