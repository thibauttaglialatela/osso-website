<?php

namespace App\Form;

use App\Entity\Contact;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'required' => false,
                'label' => 'Nom',
                'label_attr' => ['class' => 'fs-4 text-light'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'e-mail',
                'label_attr' => ['class' => 'fs-4 text-light'],
            ])
            ->add('subject', TextType::class, [
                'label' => 'sujet',
                'label_attr' => ['class' => 'fs-4 text-light'],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'label_attr' => ['class' => 'fs-4 text-light'],
                'attr' => [
                    'cols' => '5',
                    'rows' => '5',
                ],
            ])
            ->add('hasAcceptedPrivacy', CheckboxType::class, [
                'required' => true,
                'label' => "En cochant cette case, j'accepte que les données collectées, nom et e-mail, soient utilisés par l'Orchestre Symphonique du Sud Ouest afin d'apporter une réponse à ma demande. Conformément à notre politique de confidentialité, les données transmises ne seront pas conservées dans notre base de données et seront effacées après traitement du formulaire.",
                'label_attr' => ['class' => 'fs-6 text-light'],
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success mt-2',
                ],
                'label' => 'Envoyer votre message',
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'Contact',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'sanitize_html' => true,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'contact_item',
        ]);
    }
}
