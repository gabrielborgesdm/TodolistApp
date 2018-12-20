<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Form\TaskType;
use AppBundle\Entity\Tasks;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends Controller{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(Request $request){


        /* Render task's form */
        $addTask = new Tasks();

        $taskForm = $this->createForm(TaskType::class, $addTask);


        $taskForm->handleRequest($request);

        if ($taskForm->isSubmitted() && $taskForm->isValid()) {
            $task = $taskForm->getData();

            /*Set user of the task */
            $user = $this->getUser();
            $id = $user->getId();
            $task->setUser_id($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            $this->redirectToRoute("homepage");
        }


        if($user = $this->getUser()){
            $id = $user->getId();
            $task = $this->getDoctrine()
                ->getRepository(Tasks::class)
                ->findBy(['user_id' => $user->getId()]);
        } else {
            $task = [];
        }

        return $this->render("index.html.twig", array(

            "tasks" => $task,
            "form" => $taskForm->createView()
        ));
    }

}
