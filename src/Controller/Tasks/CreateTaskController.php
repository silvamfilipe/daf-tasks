<?php
/**
 * Created by PhpStorm.
 * User: fsilva
 * Date: 22-11-2018
 * Time: 10:17
 */

namespace App\Controller\Tasks;


use App\CreateTaskCommand;
use App\CreateTaskHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateTaskController
 * @package App\Controller\Tasks
 */
class CreateTaskController extends Controller
{

    /**
     * @var CreateTaskHandler
     */
    private $handler;

    public function __construct(CreateTaskHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/tasks/add")
     */
    public function create()
    {
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $command = new CreateTaskCommand($description);
        $this->handler->handle($command);

        return $this->redirect("/");
    }

}