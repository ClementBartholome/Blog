<?php 

require_once 'AbstractEntity.php';

class Article extends AbstractEntity {
    private $id;
    private $date;
    private $title;
    private $content;
    private $image;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getDate(): string {
        return $this->formatDate($this->date);
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }
}

