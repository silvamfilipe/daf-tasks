<?php
/**
 * Created by PhpStorm.
 * User: fsilva
 * Date: 28-11-2018
 * Time: 17:32
 */

namespace App\Controller\Tasks;

use App\Application\FinishTaskCommand;
use App\Application\FinishTaskHandler;
use App\Domain\Task\TaskId;
use App\Domain\TasksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TaskListController extends Controller
{

    /**
     * @var TasksRepository
     */
    private $tasksRepository;
    /**
     * @var FinishTaskHandler
     */
    private $finishTaskHandler;

    public function __construct(
        TasksRepository $tasksRepository,
        FinishTaskHandler $finishTaskHandler
    ) {
        $this->tasksRepository = $tasksRepository;
        $this->finishTaskHandler = $finishTaskHandler;
    }

    /**
     * @param $taskId
     *
     * @Route("/task/{taskId}/finish")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function finish($taskId)
    {
        $taskId = new TaskId($taskId);

        $this->finishTaskHandler
            ->handle(
                new FinishTaskCommand($taskId)
            );

        return $this->redirect('/');
    }

    /**
     * @return string
     * @Route("")
     */
    public function home()
    {
        $tasks = $this->tasksRepository->tasks();
        return $this->render(
            'home-page.html.twig',
            ['tasks' => $tasks]
        );
    }
}
