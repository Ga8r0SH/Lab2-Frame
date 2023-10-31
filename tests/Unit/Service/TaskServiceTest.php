<?php
use PHPUnit\Framework\TestCase;
use App\Service\TaskService;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskServiceTest extends TestCase
{
    private $entityManager;
    private $taskService;

    protected function setUp(): void
    {
        // Create a mock of the EntityManager
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->taskService = new TaskService($this->entityManager);
    }

    public function testCreateTask()
    {
        $task = new Task();

        // Expect that the EntityManager's persist and flush methods are called
        $this->entityManager->expects($this->once())->method('persist')->with($task);
        $this->entityManager->expects($this->once())->method('flush');

        $this->taskService->createTask($task);
    }

    public function testUpdateTask()
    {
        $task = new Task();

        // Expect that the EntityManager's flush method is called
        $this->entityManager->expects($this->once())->method('flush');

        $this->taskService->updateTask($task);
    }

    public function testDeleteTask()
    {
        $task = new Task();

        // Expect that the EntityManager's remove and flush methods are called
        $this->entityManager->expects($this->once())->method('remove')->with($task);
        $this->entityManager->expects($this->once())->method('flush');

        $this->taskService->deleteTask($task);
    }


}
