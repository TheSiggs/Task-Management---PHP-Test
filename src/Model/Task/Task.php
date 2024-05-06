<?php

namespace App\Model\Task;

use DateTime;

class Task {
    public function __construct(
        private int $id,
        private string $name,
        private DateTime $dueDate,
    ) {
    }

    public function getDueDate(): DateTime {
        return $this->dueDate;
    }

    public function setDueDate(DateTime $dueDate): void {
        $this->dueDate = $dueDate;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
}