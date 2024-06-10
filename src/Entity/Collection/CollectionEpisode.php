<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use PDO;

class CollectionEpisode
{
    public static function findBySeasonId(int $SeasonId): array
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id, seasonId, name, overview, episodeNumber
            FROM EPISODE
            WHERE seasonId = ?
            ORDER BY episodeNumber;
        ');

        $stmt->execute([$SeasonId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Episode::class);
    }

}
