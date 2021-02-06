<?php

namespace App\Form;

use App\Entity\Machine;
use App\Entity\MachineType as EntityMachineType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MachineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', TextType::class, [
                'attr'=>[
                    'class'=> 'form-control',
                    'required'=>true
                ],
                'label'=> 'Marque de la machine'
            ])
            ->add('modele', TextType::class,[
                'attr'=>[
                    'class'=> 'form-control',
                    'required'=>true
                ],
                'label'=> 'Modéle de la machine'
            ])
            ->add('nb_heure', NumberType::class, [
                'label'=> 'Nombre d\'heure de la machine',
                'attr'=>[
                    'class'=>'form-control',
                    'required'=>true
                ]
            ])
            ->add('type', EntityType::class,[
                'class'=> EntityMachineType::class,
                'choice_label'=>function(EntityMachineType $machineType){
                    return sprintf('%s', $machineType->getLibelle(),$machineType->getId());
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Machine::class,
        ]);
    }
}
