<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Patient;
use App\Entity\Treatment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TreatmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du traitement'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('posology', TextType::class, [
                'label' => 'Posologie'
            ])
            ->add('validation', ChoiceType::class, [
                'label' => 'Validation par équipe soignante',
                'choices' => [
                    'Vu et validé par équipe soignante' => 'Vu et validé par équipe soignante',
                    'En attente de validation' => 'En attente de validation'
                ]
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut du traitement',
                'choices' => [
                    'En cours' => 'En cours',
                    'Stoppé' => 'Stoppé'
                ]
            ])
            ->add('patients', EntityType::class, [
                'label' => 'Patient concerné',
                'class' => Patient::class,
'choice_label' => 'name',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Treatment::class,
        ]);
    }
}
