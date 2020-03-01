<?php

namespace AffectationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ArgentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('montant')

            ->add('date',DateType::class)
            ->add('demande',EntityType::class,['class'=>'AffectationBundle\Entity\Demande','choice_label'=>'remarque',
                'multiple'=>false,'expanded'=>false])
            ->add('affectation',EntityType::class,['class'=>'AffectationBundle\Entity\Affectation','choice_label'=>'remarque',
                'multiple'=>false,'expanded'=>false]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AffectationBundle\Entity\Argent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'affectationbundle_argent';
    }


}
