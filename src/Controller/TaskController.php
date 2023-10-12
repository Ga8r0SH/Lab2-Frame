<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/task', name: 'app_task')]
class TaskController extends AbstractController
{
    #[Route('/create', name: 'create')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task;
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();
            $entityManager->persist($task);
            $entityManager->persist($task);
            $entityManager->flush();
           return $this->redirectToRoute('app_taskcreate');
        }

        return $this->render('task/index.html.twig', [
            'task_form' => $form,
        ]);

    }
    #[Route('/delete/{id}', name:'task_delete')]

    public function delete(Request $request, EntityManagerInterface $entityManager, $id): Response
{
    // Получаем задачу по ID
    $task = $entityManager->getRepository(Task::class)->find($id);

    if (!$task) {
        throw $this->createNotFoundException('Задача не найдена');
    }

    // Удаляем задачу
    $entityManager->remove($task);
    $entityManager->flush();

    // После удаления задачи, перенаправляем на страницу списка задач или другую подходящую страницу
    return $this->redirectToRoute('task_delete');
}

#[Route('/list', name: 'list')]
public function list(TaskRepository $taskRepository): Response
{
    $tasks = $taskRepository->findAll();

    return $this->render('task/list.html.twig', [
        'tasks' => $tasks,
    ]);
}

#[Route('/view/{id}', name: 'view')]
    public function view(int $id, TaskRepository $taskRepository): Response
    {
        $task = $taskRepository->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Task not found');
        }

        return $this->render('task/view.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(int $id, Request $request, TaskRepository $taskRepository, EntityManagerInterface $entityManager): Response
    {
        $task = $taskRepository->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Task not found');
        }

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_task_view', ['id' => $task->getId()]);
        }

        return $this->render('task/update.html.twig', [
            'task' => $task,
            'task_form' => $form->createView(),
        ]);
    }


}