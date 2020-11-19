<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\MotCle;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('slug', null, [
                'required'   => false,
            ])
            ->add('contenu')
            ->add('featured_image')
            ->add('categories', EntityType::class, [
                // looks for choices from this entity
                'class' => Categorie::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nom',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('motCles', EntityType::class, [
                // looks for choices from this entity
                'class' => MotCle::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'mot_cle',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
