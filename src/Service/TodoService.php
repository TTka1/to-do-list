<?php

namespace App\Service;

use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;

class TodoService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function addAction()
    {
       // $messages = 'Tomislav';

        //$todo = new Todo();
        //$todo->setName($messages);

        //dd($messages);
        //$this->entityManager->persist($todo);

        //$this->entityManager->flush();
        //dd($messages);

        //return $todo;
    }

    public function saveList(?Todo $todo)
    {
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }

}