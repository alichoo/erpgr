<?php

namespace App\Form;

use App\Entity\Fgrh;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class FgrhType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[ 'attr' => ['class' => 'form-control']])
            ->add('cat',TextType::class,[ 'attr' => ['class' => 'form-control','pattern'=>'[0-9]+']])
            ->add('file', FileType::class, [
                'label' => 'Upload File',
                'mapped' => false,  // This tells Symfony not to map this field to the entity directly
                'required' => true,
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fgrh::class,
        ]);
    }
}
