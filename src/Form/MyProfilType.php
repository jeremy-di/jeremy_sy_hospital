<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Patient;
use App\Form\MyProfilType;
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

class MyProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom'
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
