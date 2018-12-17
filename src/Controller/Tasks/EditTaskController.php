<?php

namespace App\Controller\Tasks;

use App\Domain\Task\TaskId;
use App\Domain\TasksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditTaskController extends Controller
{
    /**
     * @var TasksRepository
     */
    private $tasks;

    public function __construct(TasksRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param string $taskId
     *
     * @param Request $request
     * @return Response
     * @Route("/task/{taskId}/edit")
     *
     */
    public function edit(string $taskId, Request $request)
    {

        if ($request->getMethod() === 'POST') {
            return $this->redirect('/');
        }

        try {
            $task = $this->tasks->withTaskId(new TaskId($taskId));
        } catch (\Exception $e) {
            return new Response($e->getMessage());
        }

        return $this->render('edit-form.html.twig', compact('task'));
    }
}