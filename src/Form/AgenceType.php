<?php

namespace App\Form;

use App\Entity\Agences;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Adresse', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'adresse est obligatoire'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'L\'adresse doit contenir au moins {{ limit }} caractères',
                        'max' => 255,
                        'maxMessage' => 'L\'adresse ne peut pas dépasser {{ limit }} caractères'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Adresse',
                    'class' => 'form-control'
                ]
            ])
            ->add('Telephone', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le numéro de téléphone est obligatoire'
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le numéro doit contenir au moins {{ limit }} chiffres',
                        'max' => 15,
                        'maxMessage' => 'Le numéro ne peut pas dépasser {{ limit }} chiffres'
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9\s\+\-\.]+$/',
                        'message' => 'Le numéro de téléphone ne doit contenir que des chiffres et les caractères +, -, .'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Téléphone',
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agences::class,
            'allow_extra_fields' => true
        ]);
    }
}