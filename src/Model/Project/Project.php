<?php

namespace App\Model\Project;

use App\Model\Task\Task;
use Illuminate\Support\Collection;
use RuntimeException;

class Project {

    /**
     * Initializes a new instance of the Project class with a name and an optional collection of tasks.
     * @param string $name The name of the project.
     * @param Collection<int, Task> $tasks An optional collection of tasks associated with the project.
     * @throws RuntimeException
     */
    public function __construct(
        private string $name,
        private readonly Collection $tasks = new Collection()
    ) {
        if (empty($name)) {
            throw new RuntimeException('Project name must not be empty');
        }
    }

    /**
     * Adds a task to the project.
     * @param Task $task Task to add to project
     * @return void
     */
    public function addTask(Task $task): void {
        $id = $task->getId();

        if ($this->tasks->has($id)) {
            throw new RuntimeException("A task with the ID {$id} already exists.");
        }

        if ($id < 0) {
            throw new RuntimeException("Only positive integers are allowed.");
        }

        if (empty($task->getName())) {
            throw new RuntimeException('Task name must not be empty');
        }

        $this->tasks->put($id, $task);
    }


    /**
     * Finds a task by its ID.
     * @param int $id The ID of the task to find.
     * @return Task|null The found task, or null if not found.
     */
    public function findTask(int $id): ?Task {
        return $this->tasks->get($id);
    }

    /**
     * Deletes a task from the project by its ID.
     * @param int $id The ID of the task to delete.
     * @return Project Returns the instance of the project for chaining.
     */
    public function deleteTask(int $id): Project {
        $this->tasks->forget($id);
        return $this;
    }

    /**
     * Gets the name of a task by its ID.
     * @param int $id The ID of the task.
     * @return string|null The name of the task, or null if the task does not exist.
     */
    public function getTask(int $id): ?string {
        return $this->findTask($id)?->getName();
    }

    /**
     * Get list of tasks in project
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection {
         return $this->tasks;
    }

    /**
     * Get Project Name
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set project name
     * @param string $name
     * @return Project
     */
    public function setName(string $name): Project {
        $this->name = $name;
        return $this;
    }
}
