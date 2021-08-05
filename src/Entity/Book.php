<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{

    public function __construct()
    {
        $this->datePublished = new DateTime('now');
    }

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    //(name="title", type="string", length=100, nullable=false, unique=true)
    private string $title;

    /**
     * @var string
     * @ORM\Column(name="author", type="string", length=100, nullable=false)
     */
    private string $author;

    /**
     * @var int
     * @ORM\Column(name="pages", type="integer", nullable=false)
     */
    private int $pages;

    /**
     * @var DateTime
     * @ORM\Column(name="date_published", type="datetime", nullable=false)
     */
    private DateTime $datePublished;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     */
    public function setPages(int $pages): void
    {
        $this->pages = $pages;
    }

    /**
     * @return DateTime
     */
    public function getDatePublished(): DateTime
    {
        return $this->datePublished;
    }

    /**
     * @param DateTime $datePublished
     */
    public function setDatePublished(DateTime $datePublished): void
    {
        $this->datePublished = $datePublished;
    }
}