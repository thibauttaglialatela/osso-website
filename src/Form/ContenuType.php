<?php

namespace App\Form;

use App\Entity\Contenu;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('poster', TextType::class, [
                'label' => 'image',
                'help' => 'image non obligatoire',
                'required' => false
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alternatif',
                'help' => 'description de la photo - obligatoire si la photo est téléchargée',
                'required' => false,
                'empty_data' => 'a picture'
            ])
            ->add('identifier', ChoiceType::class, [
                'label' => 'identifiant',
                'choices' => [
                    'historique de l\'orchestre' => 'orchestra-history',
                    'biographie du chef' => 'director-biography',
                    'membres du CA' => 'conseil administration',
                ],
                'expanded' => true,
                'placeholder' => 'faites un choix'
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('body', CKEditorType::class, [
                'label' => 'Contenu',
                'attr' => ['row' => 30]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contenu::class,
        ]);
    }
}
