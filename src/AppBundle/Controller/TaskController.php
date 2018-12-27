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
