<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Formation;
use App\Entity\Playlist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DateTime;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text', 'data' => isset($options['data']) && 
                    $options['data']->getPublishedAt() != null ? $options['data']->getPublishedAt(): new DateTime('now'), 'label' => 'date'
            ])
            ->add('title', null, ['label'=> 'titre'])
            ->add('description')
            ->add('videoId', null, ['label'=>'selection video'])
            ->add('playlist', EntityType::class, [
                'class' => Playlist::class,
                'choice_label' => 'name'
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('submit', SubmitType::class, ['label'=> 'enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
