<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Résumé',
                'attr' => [
                    'col' => 10,
                    'row' => 10
                ],
            ])
            ->add('body', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'col' => 10,
                    'row' => 30
                ],
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'placeholder' => false,
                    'Concert' => 'Concert',
                    'Répétition' => 'Répétition'
                ],
            ])
            ->add('poster', UrlType::class, [
                'label' => 'Illustration'
            ])
            ->add('start_at', DateTimeType::class, [
                'date_label' => 'Débute à',
                'date_widget' => 'single_text',
            ])
            ->add('end_at', DateTimeType::class, [
                'date_label' => 'Se termine à',
                'date_widget' => 'single_text',
            ])
            ->add('localisation', TextType::class, [
                'label' => 'Lieu de l\'évenement'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
