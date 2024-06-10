<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Poster
{
    private int $id;
    private string $jpeg;

    public function getId(): int
    {
        return $this->id;
    }

    public function getJpeg(): string
    {
        return $this->jpeg;
    }
    public static function findById(int $id): Poster
    {
        $stmt = MyPDO::getInstance()->prepare('
                SELECT id,jpeg
                FROM poster
                WHERE id = ?
        ');
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_CLASS, Poster::class);
        if (!isset($res[0])) {
            throw new EntityNotFoundException("No data has been found");
        }
        return $res[0];
    }

}