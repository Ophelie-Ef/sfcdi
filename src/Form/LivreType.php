<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('auteur')
            ->add('editeur')
            ->add('isbn')
            ->add('date_publication')
            ->add('resume')
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('image', FileType::class, [
                'label' => 'Première de couverture :',
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
