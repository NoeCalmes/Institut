<?php

namespace App\Form;

use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignMatieresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matieres', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true, // Utilisez 'false' pour un select multiple
                'label' => 'Sélectionnez les Matières à Assigner',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Aucune classe de données nécessaire ici
            // Nous gérerons l'association directement dans le contrôleur
            'data_class' => null,
        ]);
    }
}
