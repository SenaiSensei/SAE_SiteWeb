<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class CollectionGenre
{
    public static function findByGenreId(int $id): array
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id, name
            FROM genre
            WHERE id = ?;
        ');

        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Genre::class);
    }

}