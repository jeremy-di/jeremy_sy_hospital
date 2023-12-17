<?php

namespace App\Form;

use App\Entity\Room;
use App\Entity\User;
use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', TextType::class, [
                'label' => 'Numéro de chambre'
            ])
            ->add('service', ChoiceType::class, [
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
            ->add('type', ChoiceType::class, [
                'label' => 'Type de chambre',
                'choices' => [
                    'Box des urgences' => 'Box des urgences',
                    'Chambre de service' => 'Chambre de service',
                    'Salle de réveil' => 'Salle de reveil',
                    'Chambre de garde' => 'Chambre de garde'
                ]
            ])
            ->add('patient', EntityType::class, [
                'label' => 'Patient attribué',
                'class' => Patient::class,
                'required' => false,
'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
