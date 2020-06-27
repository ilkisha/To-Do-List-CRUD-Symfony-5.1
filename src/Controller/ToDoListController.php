<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function create()
    {
        exit('to do: create a new task!');
    }

    /**
     * @Route("/switch-status/{id}", name="switch_status")
     * @param int $id
     */
    public function switchStatus(int $id): void
    {
        exit('to do: Switch status of the task!' . $id);
    }

    /**
     * @Route("/delete/{id}", name="task_delete")
     * @param int $id
     */
    public function delte(int $id): void
    {
        exit('to do: Delete a task with the id of ' . $id);
    }
}
