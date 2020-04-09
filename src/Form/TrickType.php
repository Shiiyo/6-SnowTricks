<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\TrickGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Titre'])
            ->add('content', TextareaType::class, ['label' => 'Contenu', 'attr' => ['rows' => '10']])
            ->add('trickGroup', EntityType::class, [
                'class' => TrickGroup::class,
                'choice_label' => 'name',
                'label' => 'Groupe de trick',
            ])
            ->add('frontPicture', FileType::class, [
                'mapped' => false,
                'required' => false,
                ])
            ->add('pictures', CollectionType::class, [
                'mapped' => false,
                'entry_type' => PictureType::class,
                'by_reference' => false,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => TextType::class,
                'by_reference' => false,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'mapped' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
