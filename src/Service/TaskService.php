<?php
// src/Service/TaskService.php

namespace App\Service;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createTask(Task $task)
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function updateTask(Task $task)
    {
        $this->entityManager->flush();
    }

    public function deleteTask(Task $task)
    {
        // Отладочный вывод: убедитесь, что $task существует перед удалением
        dump($task);
    
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }
    

    public function getTaskById(int $id)
    {
        return $this->entityManager->getRepository(Task::class)->find($id);
    }

    public function getAllTasks()
    {
        return $this->entityManager->getRepository(Task::class)->findAll();
    }
}
