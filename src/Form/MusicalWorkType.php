<?php

namespace App\Form;

use App\Entity\Compositor;
use App\Entity\MusicalWork;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicalWorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "titre de l'oeuvre",
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Joué' => 'Joué',
                    'En cours' => 'En cours',
                    'Jamais joué' => 'Jamais joué',
                ],
                'label' => 'Status'
            ])
            ->add('compositor', EntityType::class, [
                'class' => Compositor::class,
                'choice_label' => 'name'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MusicalWork::class,
        ]);
    }
}
