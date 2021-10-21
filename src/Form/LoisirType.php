<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Loisir;
use App\Entity\activity;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoisirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', EntityType::class, [
                'class' => Loisir::class,
                'choice_label' => 'name',
            ])
            /*->add('name', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'name',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Loisir::class,
        ]);
    }
}
