<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)
            ->findBy([], ['id' => 'DESC']);

        return $this->render('index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $title = trim($request->request->get('title'));
        if(empty($title)){
            return $this->redirectToRoute('to_do_list');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setTitle($title);
        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }

    /**
     * @Route("/switch-status/{id}", name="switch_status")
     * @param int $id
     * @return RedirectResponse
     */
    public function switchStatus(int $id): RedirectResponse
    {
        $task = new Task();
        $entityManager = $this->getDoctrine()->getManager();
        $task = $entityManager->getRepository(Task::class)->find($id);

        $task->setStatus( ! $task->getStatus());
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }

    /**
     * @Route("/delete/{id}", name="task_delete")
     * @param int $id
     */
    public function delete(int $id): void
    {
        exit('to do: Delete a task with the id of ' . $id);
    }
}
