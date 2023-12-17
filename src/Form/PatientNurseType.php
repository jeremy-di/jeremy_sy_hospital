<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Patient;
use App\Entity\Treatment;
use App\Form\PatientNurseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PatientNurseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstName', textType::class, [
                'label' => 'Prénom'
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Adresse postale'
            ])
            ->add('zipCode', NumberType::class, [
                'label' => 'Code postal'
            ])
            ->add('town', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('inseeNumber', NumberType::class, [
                'label' => 'Numéro de sécurité sociale'
            ])
            ->add('medicalMutual', TextType::class, [
                'label' => 'Mutuelle santé'
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
