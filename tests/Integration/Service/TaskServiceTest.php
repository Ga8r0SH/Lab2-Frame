<?php
// tests/Service/TaskServiceTest.php

namespace App\tests\Integration\Service;

use App\Entity\Task;
use App\Service\TaskService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\SerializerInterface;

class TaskServiceTest extends KernelTestCase
{
    private $entityManager;
    private $taskService;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->taskService = new TaskService($this->entityManager);
    }

    

    public function testUpdateTask()
    {
        // Implement your test for updateTask here
    }

    public function testDeleteTask()
    {
        // Implement your test for deleteTask here
    }

    public function testGetTaskById()
    {
        // Implement your test for getTaskById here
    }

    public function testGetAllTasks()
    {
        // Implement your test for getAllTasks here
    }
}
