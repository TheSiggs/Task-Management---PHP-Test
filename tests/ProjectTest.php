<?php

use App\Model\Project\Project;
use App\Model\Task\Task;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    public function test_project_name_is_set(): void
    {
        $name = 'Test project';
        $project = new Project($name);

        $this->assertEquals($name, $project->getName());
    }

    public function test_adding_tasks_increases_task_count(): void
    {
        $project = new Project('Test project');

        $project->addTask(new Task(0, 'Book pre-wrap inspection'));
        $project->addTask(new Task(1, 'Garage door install'));
        $project->addTask(new Task(2, 'Appliance Delivery'));

        $this->assertCount(3, $project->getTasks());
    }

    public function test_get_task_by_id(): void
    {
        $project = new Project('Test project');
        $project->addTask(new Task(0, 'Book pre-wrap inspection'));
        $project->addTask(new Task(1, 'Garage door install'));

        $task = $project->getTask(1);

        $this->assertEquals('Garage door install', $task);
    }

    public function test_delete_task_by_id(): void
    {
        $project = new Project('Test project');
        $project->addTask(new Task(0, 'Book pre-wrap inspection'));
        $project->addTask(new Task(1, 'Garage door install'));

        $project->deleteTask(1);

        $this->assertCount(1, $project->getTasks());
    }

    public function test_delete_task_by_invalid_id(): void
    {
        $project = new Project('Test project');
        $project->addTask(new Task(0, 'Book pre-wrap inspection'));
        $project->addTask(new Task(1, 'Garage door install'));

        $project->deleteTask(99);

        $this->assertCount(2, $project->getTasks());
    }

    public function test_adding_a_task_to_the_project(): void {
        $project = new Project('Test Project');
        $project->addTask(new Task(1, 'Test Task'));

        $this->assertCount(1, $project->getTasks());
        $this->assertInstanceOf(Task::class, $project->getTasks()->get(1));
        $this->assertEquals('Test Task', $project->getTasks()->get(1)->getName());
    }

    public function test_adding_a_task_with_nagative_id_to_the_project(): void {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Only positive integers are allowed.");

        $project = new Project('Test Project');
        $project->addTask(new Task(-1, 'Test Task'));
    }


    public function test_throws_exception_when_adding_a_task_with_duplicate_id(): void {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("A task with the ID 1 already exists.");

        $project = new Project('Test Project');
        $project->addTask(new Task(1, 'First Task'));
        $project->addTask(new Task(1, 'Duplicate Task'));
    }

    public function test_find_a_task_by_id(): void {
        $project = new Project('Test Project');
        $project->addTask(new Task(1, 'Test Task'));
        $project->addTask(new Task(2, 'Test Task 2'));

        $task = $project->findTask(1);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals('Test Task', $task->getName());
    }

    public function test_returns_null_when_task_not_found(): void {
        $project = new Project('Test Project');
        $task = $project->findTask(99);

        $this->assertNull($task);
    }

    public function test_returns_null_when_cannot_find_task(): void {
        $project = new Project('Test Project');
        $task = $project->getTask(99);

        $this->assertNull($task);
    }

    public function test_new_project_starts_with_no_tasks(): void {
        $project = new Project('Empty Project');
        $this->assertCount(0, $project->getTasks(), 'New project should start with an empty tasks collection.');
    }

    public function test_modification_after_deletion(): void
    {
        $project = new Project('Test project');
        $project->addTask(new Task(0, 'Book pre-wrap inspection'));
        $project->addTask(new Task(1, 'Garage door install'));

        $project->deleteTask(1);

        $project->addTask(new Task(1, 'New Garage door install'));

        $this->assertCount(2, $project->getTasks());
    }

    public function test_adding_task_with_empty_name_throws_exception(): void
    {
        $this->expectException(RuntimeException::class);
        $project = new Project('Test Project');
        $project->addTask(new Task(1, ''));
    }

    public function test_creating_project_with_empty_name_throws_exception(): void
    {
        $this->expectException(RuntimeException::class);
        $project = new Project('');
        $project->addTask(new Task(1, 'Test Task'));
    }

    public function test_delete_task_with_invalid_id_type(): void
    {
        $this->expectException(TypeError::class);
        $project = new Project('Test Project');
        $project->deleteTask('invalid'); // @phpstan-ignore-line
    }
}
