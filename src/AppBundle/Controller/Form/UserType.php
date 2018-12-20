<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17/12/2018
 * Time: 08:24
 */

namespace AppBundle\Controller\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType {
    public function BuildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('name', TextType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class
            ]);

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}