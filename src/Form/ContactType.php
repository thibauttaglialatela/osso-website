<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'required'=>false,
                'label'=>'Nom',
                'label_attr'=>['class'=>'fs-4']
            ])
            ->add('email', EmailType::class, [
                'label' => 'e-mail',
                'label_attr'=>['class'=>'fs-4']
            ])
            ->add('subject', TextType::class, [
                'required'=>false,
                'label'=>'sujet',
                'label_attr'=>['class'=>'fs-4'],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'label_attr'=>['class'=>'fs-4'],
                'attr'=>[
                    'cols'=> '5',
                    'rows'=>'5',
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class'=>'btn btn-success mt-2'
                ],
                'label' => 'Envoyer votre message'
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'Contact',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'sanitize_html' => true,
        ]);
    }
}
