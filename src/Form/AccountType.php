<?php

namespace App\Form;

use App\DTO\AccountDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('picture', FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AccountDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new AccountDTO(
                    $form->get('username'),
                    $form->get('email'),
                    $form->get('picture')
                );
            },
        ]);
    }
}
