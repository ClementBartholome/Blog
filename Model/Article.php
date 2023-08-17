<?php

require_once 'AbstractEntity.php';

class Article extends AbstractEntity {
    private $id;
    private $date;
    private $title;
    private $content;
    private $image;

    private $category;

    public function hydrate(array $data) {
        parent::hydrate($data);
        if (isset($data['date'])) {
            $this->date = $this->formatDate($data['date']);
        }
        $this->category = $data['category'] ?? null;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }

    public function getCategory(): string {
        return $this->category ?? '';
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }

    public function getImage(): ?string {
        return $this->image;
    }
}
