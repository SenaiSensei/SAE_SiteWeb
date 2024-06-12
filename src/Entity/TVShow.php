<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class TVShow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homePage;
    private string $overview;
    private ?int $posterId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): TVShow
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TVShow
    {
        $this->name = $name;
        return $this;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): TVShow
    {
        $this->originalName = $originalName;
        return $this;
    }

    public function getHomePage(): string
    {
        return $this->homePage;
    }

    public function setHomePage(string $homePage): TVShow
    {
        $this->homePage = $homePage;
        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): TVShow
    {
        $this->overview = $overview;
        return $this;
    }

    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    public function setPosterId(?int $posterId): TVShow
    {
        $this->posterId = $posterId;
        return $this;
    }

    public static function findById(int $id) : TVShow
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT id,name,originalName,homePage,overview,posterId
                FROM tvshow
                WHERE id = ?
            SQL
        );
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_CLASS, TVShow::class);
        if (!isset($res[0])) {
            throw new EntityNotFoundException("No data has been found");
        }
        return $res[0];
    }

    public static function findByGenreId(int $id): TVShow
    {
        $stmt = MyPdo::getInstance()->prepare('
            SELECT id,name,originalName,homePage,overview,posterId
            FROM tvshow
            WHERE id in (SELECT tvShowId
                         FROM tvshow_genre
                         WHERE genreId = ?);
        ');

        $stmt->execute([$id]);
        $res= $stmt->fetchAll(PDO::FETCH_CLASS, TVShow::class);
        if (!isset($res[0])) {
            throw new EntityNotFoundException("No data has been found");
        }
        return $res[0];
    }

    public static function create(string $name, string $originalName, string $homePage, string $overview, ?int $id = null, ?int $posterId = null): self
    {
        $tvShow = new TVShow();
        $tvShow->setName($name);
        $tvShow->setOriginalName($originalName);
        $tvShow->setHomePage($homePage);
        $tvShow->setOverview($overview);
        $tvShow->setId($id);
        $tvShow->setPosterId($posterId);
        return $tvShow;
    }

    private function __construct()
    {
    }

    protected function update(): TVShow
    {
        $stmt = MyPdo::getInstance()->prepare('UPDATE tvshow SET name = ?,originalName = ?,homePage = ?,overview = ? WHERE id = ?');
        $stmt->execute([$this->name,$this->originalName,$this->homePage,$this->overview,$this->id]);
        return $this;
    }

    protected function insert(): self
    {
        $stmt = MyPdo::getInstance()->prepare(
            'INSERT INTO tvshow (name,originalName,homepage,overview) VALUES (:name, :originalName,:homePage, :overview)'
        );

        $stmt->execute([':name' => $this->name,
            ':originalName' => $this->originalName,
            ':homePage' => $this->homePage,
            ':overview' => $this->overview]);

        $this->setId((int) MyPdo::getInstance()->lastInsertId());

        return $this;
    }

    public function save(): TVShow
    {
        if ($this->getId() === null) {
            $output = $this->insert();
        } else {
            $output = $this->update();
        }
        return $output;
    }



}