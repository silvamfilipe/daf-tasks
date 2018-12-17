<?php
/**
 * Created by PhpStorm.
 * User: fsilva
 * Date: 22-11-2018
 * Time: 10:12
 */

namespace App\Infrastructure\Persistence\Doctrine;


use App\Domain\Task;
use App\Domain\Task\Status;
use App\Domain\Task\TaskId;
use App\Domain\TasksRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTasksRepository implements TasksRepository
{

    /**
     * @var EntityManager|EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Task $task
     * @return Task
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Task $task): Task
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }

    /**
     * @param Status|null $status
     * @return array
     */
    public function tasks(Status $status = null): array
    {
        $sql = "SELECT t FROM ".Task::class." t";
        return $this->entityManager->createQuery($sql)
            ->getResult();
    }

    /**
     * @param TaskId $taskId
     * @return Task
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function withTaskId(TaskId $taskId): Task
    {
        $task = $this->entityManager->find(Task::class, $taskId);

        if (! $task instanceof Task) {
            throw new \RuntimeException(
                "Task not found."
            );
        }

        return $task;
    }

    /**
     * @param Task $task
     *
     * @return Task
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Task $task): Task
    {
        $this->entityManager->flush($task);
        return $task;
    }
}
