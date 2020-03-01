<?php

namespace AffectationBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('remarque')->add('etat')->add('cas')->add('date' ,DateType::class)
            ->add('equipements',EntityType::class,['class'=>'AffectationBundle\Entity\Equipment','choice_label'=>'nom',
                'multiple'=>true,'expanded'=>true])
            ->add('services',EntityType::class,['class'=>'AffectationBundle\Entity\Service','choice_label'=>'nom',
                'multiple'=>true,'expanded'=>true])
            ->add('argents',EntityType::class,['class'=>'AffectationBundle\Entity\Argent','choice_label'=>'montant',
                'multiple'=>true,'expanded'=>true]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AffectationBundle\Entity\Demande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'affectationbundle_demande';
    }


}
