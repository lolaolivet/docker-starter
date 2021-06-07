<?php

namespace App\Form\Type;

use App\Entity\DifficultyLevel;
use App\Entity\Lines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LineEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
//            ->add('difficulty', ArrayT)
            ->add('save', SubmitType::class, ['label' => 'Edit'])
            ->getForm();
    }
}