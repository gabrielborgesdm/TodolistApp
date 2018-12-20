<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller {
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator) {

        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute("login");

        } else {

            return $this->render('Authentication/register.html.twig', [
                'registerForm' => $form->createView()
            ]);
        }       

        return $this->render('index.html.twig', [
            'registerForm' => $form->createView()
        ]);
    }

}

