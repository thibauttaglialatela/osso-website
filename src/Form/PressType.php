<?php

namespace App\Form;

use App\Entity\Press;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('newspaper', TextType::class, [
                'label' => 'Journal'
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'article',
            ])
            ->add('article_date', DateType::class, [
                'label' => 'Date de l\'article',
                'widget' => 'single_text'
            ])
            ->add('article_link', UrlType::class, [
                'label' => 'lien vers l\'article'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Press::class,
        ]);
    }
}
