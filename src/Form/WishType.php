<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'row_attr' => ['class' => 'input-group mb-3'
                ],
                'label' => 'Titre'
            ])
            ->add('description', TextType::class, [
                'row_attr' => ['class' => 'input-group mb-3']
            ])
            ->add('author', TextType::class, [
                'row_attr' => ['class' => 'input-group mb-3']
            ])
            ->add('isPublished', CheckboxType::class, [
                'row_attr' => ['class' => 'input-group mb-3']
            ])
            ->add('dateCreated', DateType::class, [
                'widget' => 'single_text',
                'row_attr' => ['class' => 'input-group mb-3']
            ])
            ->add('category', EntityType::class, [
                'required' => false,
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => '--Veuillez choisir une catégorie--',
                'row_attr' => [
                    'class' => 'input-group mb-3'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
