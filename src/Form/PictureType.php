<?php

namespace App\Form;

use App\DTO\PictureDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', FileType::class, [
            'required' => false,
            'label' => false,
            'mapped' => false,
            'attr' => ['class' => 'form-control-file',
                'type' => 'file',
            ],
            'data_class' => null,
            'constraints' => [new Image([
                'minWidth' => 200,
                'minWidthMessage' => 'L\'image est trop petite: {{ width }}px. Le minimum autorisé est de {{ min_width }}px.',
                'maxWidth' => 5000,
                'maxWidthMessage' => "L'image est trop large: {{ width }}px. Le maximum autorisé est de {{ max_width }}px.",
                'minHeight' => 200,
                'minHeightMessage' => "L'image est trop petite: {{ height }}px. Le mminimum autorisé est de {{ min_height }}px.",
                'maxHeight' => 5000,
                'maxHeightMessage' => "L'image est trop haute: {{ height }}px. Le maximum autorisé est de {{ max_height }}px.",
                'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                'mimeTypesMessage' => "Le format de l'image n'est pas bon. Format accepté: JPEG, PNG et GIF.",
            ])],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PictureDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new PictureDTO(
                  $form->get('file')->getData()
                );
            },
        ]);
    }
}
