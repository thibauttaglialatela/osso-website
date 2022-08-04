<?php

namespace App\Form;

use App\Entity\Instrument;
use App\Entity\Musician;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicianType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Amateur' => 'Amateur',
                    'Professionnel' => 'Professionnel',
                ],
                'label' => 'Statut',
            ])
            ->add('instruments', EntityType::class, [
                'class' => Instrument::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Musician::class,
        ]);
    }
}
