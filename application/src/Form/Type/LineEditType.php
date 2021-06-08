<?php

namespace App\Form\Type;

use App\Entity\DifficultyLevel;
use App\Entity\Lines;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LineEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $line = $options['data'];

        dump($line);
        $builder
            ->add('name', TextType::class, ['required' => true, 'label' => 'Nom de la via ferrata:'])
            ->add('difficulties', EntityType::class, [
                'class' => DifficultyLevel::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
//                'data' => $line->getDifficulties()
            ])
            ->add('save', SubmitType::class, ['label' => 'Edit'])
            ->getForm();
    }


}