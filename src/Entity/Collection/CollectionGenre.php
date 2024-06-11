<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class CollectionGenre
{
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id, name
            FROM genre;
        ');

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Genre::class);
    }

}