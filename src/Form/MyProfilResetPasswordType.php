<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Patient;
use App\Form\MyProfilType;
use App\Form\MyProfilResetPasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class MyProfilResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'invalid_message' => 'Les mots de passe ne correspondent pas',
            'first_options' => [
                'label' => 'Entrer un mot de passe : '
            ],
            'second_options' => [
                'label' => 'Répéter le mot de passe : '
            ],
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe'
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe est trop petit',
                    'max' => 20,
                    'maxMessage' => 'Votre mot de passe est trop grand'
                ]),
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
