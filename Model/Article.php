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
        // Call the parent class's hydrate method to set common properties
        parent::hydrate($data);

        // Check if 'date' is set in the data array and format it
        if (isset($data['date'])) {
            $this->date = $this->formatDate($data['date']);
        }

        // If 'category' key exists in the data array, set category, otherwise set it to null
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
