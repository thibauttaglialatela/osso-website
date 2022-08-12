<?php

namespace App\Form;

use App\Entity\Poster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class PosterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichFileType::class, [
                'label' => 'image',
                'required' => false,
            ])
            ->add('alt', TextType::class,[
                'label' => 'Texte alternatif de l\'image',
            ])
            ->add('author', TextType::class, [
                'label' => 'auteur de la photo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Poster::class,
            "allow_extra_fields" => true,
        ]);
    }
}
