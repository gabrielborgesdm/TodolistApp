<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 18/12/2018
 * Time: 10:08
 */

namespace AppBundle\Controller\Form;

use AppBundle\Entity\Tasks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType {

    public function BuildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('description', TextareaType::class, ['attr' =>['style' => 'height:20vh; resize: none']])
            ->add('submit', SubmitType::class, ['attr' =>['class' => 'my-2 col-12 btn btn-lg btn-dark']]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Tasks::class
        ]);
    }

}