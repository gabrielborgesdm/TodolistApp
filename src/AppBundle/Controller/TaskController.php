<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Tasks;
use AppBundle\Controller\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller{
    /**
     * @Route("/create", name="create_task")
     */
    public function formBuilder(Request $request){

        $task = new Tasks();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $user = $this->getUser();
            $id = $user->getId();
            $task->setUser_id($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

        }

        return new Response();

    }


    /**
     * @Route("/update/{id}/{condition}", name="update_task")
     */

    public function updateForm( $id, $condition){
        
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $task = $entityManager->getRepository(Tasks::class)->findOneBy(['id'=>$id,'user_id'=>$user->getId()]);

        if(!$task){
            throw  new \Exception('Task not find');
        }

        $task->setCompleted($condition);
        $entityManager->flush();

        return new Response($condition);
    }
}
