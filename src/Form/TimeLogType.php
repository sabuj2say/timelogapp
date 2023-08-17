<?php

// src/Form/TimeLogType.php

namespace App\Form;
use App\Entity\TimeLog; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeLogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startTime', DateTimeType::class, [
                'label' => 'Start Time: ',
                'widget' => 'single_text',
                'data' => new \DateTime(), 
            ])
            ->add('endTime', DateTimeType::class, [
                'label' => 'End Time: ',
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('description', TextType::class, [
                'label' => 'Description: ',
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Save']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TimeLog::class, // Make sure this is set correctly
        ]);
    }
}
