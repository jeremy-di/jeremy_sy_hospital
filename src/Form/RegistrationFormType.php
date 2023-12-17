<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' =>"Nom"
            ])
            ->add('firstName', TextType::class, [
                'label' =>"Prénom"
            ])
            ->add('jobTitle', ChoiceType::class, [
                'label' => 'Titre',
                'choices' => [
                    'Médecin' => 'Medecin',
                    'Infirmier(e)' => 'Infirmiere'
                ]
            ])
            ->add('service', ChoiceType::class,[
                'label' => 'Service',
                'choices' => [
                    'Cardiologie' => 'Cardiologie',
                    'Chirurgie' => 'Chirurgie',
                    'Epidémiologie' => 'Epidemiologie',
                    'Gériatrie' => 'Geriatrie',
                    'Laboratoire' => 'Laboratoire',
                    'Néphrologie' => 'Nephrologie',
                    'Oncologie' => 'Oncologie',
                    'Pédiatrie' => 'Pediatrie',
                    'Pneumologie' => 'Pneumologie',
                    'UHTCD' => 'UHTCD',
                    'Urgences' => 'Urgences',
                    'Urgences pédiatriques' => 'Urgences pediatriques'

                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de poste telephonique'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('agreeTerms', CheckboxType::class, [
            'label' => 'Accepter les termes',
                                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
