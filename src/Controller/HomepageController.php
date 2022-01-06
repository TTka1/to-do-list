<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Forms\AddListType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TodoRepository;
use App\Service\TodoService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    /**
     * @var TodoRepository
    */
    private $todoRepository;
    /**
     * @var TodoService
     */
    private $todoservice;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(
        TodoRepository $todoRepository,
        EntityManagerInterface $entityManager,
        TodoService $todoservice)
    {
        $this->todoRepository = $todoRepository;
        $this->todoservice = $todoservice;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route({
     *     "hr": "/"}, name="homepage")
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $allLists = $this->todoRepository->findAll();
        //dd($allLists);

        $todo = new Todo();

        $form = $this->createForm(AddListType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $todo = $form->getData();

            //dd($todo);

            $this->todoservice->saveList($todo);

            return $this->redirectToRoute('homepage');
        }

        //$lists = $this->todoservice->addAction();

        return $this->render('homepage/index.html.twig', [
            'form' => $form->createView(),
            'allLists' => $allLists
        ]);
    }

    /**
     * @Route({
     *     "hr": "/{id}"}
     * , name="removeFrom")
     * @return Response
     * @param Request $request
     * @param $id
     */
    public function removeFromAction(Request $request, Todo $todo,$id)
    {
        $todo = $this->todoRepository->findOneBy(['id' => $id]);

        $this->entityManager->remove($todo);
        $this->entityManager->flush();

        return $this->redirectToRoute('homepage');
    }





}