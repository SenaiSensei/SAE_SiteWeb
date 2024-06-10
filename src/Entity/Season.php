<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(int $id): Season
    {
        $stmt = MyPDO::getInstance()->prepare('
                SELECT id,tvShowId,name,seasonNumber,posterId
                FROM season
                WHERE id = ?
        ');
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_CLASS, Season::class);
        if (!isset($res[0])) {
            throw new EntityNotFoundException("No data has been found");
        }
        return $res[0];
    }
}