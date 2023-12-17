<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Patient;
use App\Entity\Treatment;
use App\Form\TreatmentNurseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TreatmentNurseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('validation', ChoiceType::class, [
                'label' => 'Validation par équipe soignante',
                'choices' => [
                    'Vu et validé par équipe soignante' => 'Vu et validé par équipe soignante',
                    'En attente de validation' => 'En attente de validation'
                ]
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
