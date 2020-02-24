<?php

namespace ShopBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('designation')->add('description')->add('etat')->add('date')->add('idc',EntityType::class,
            ['class'=>'ShopBundle\Entity\CategorieR',
                'choice_label'=>'nomR',
                'multiple'=>false,
                'expanded'=>false
            ])->add('idp',EntityType::class,
            ['class'=>'ShopBundle\Entity\Produit',
                'choice_label'=>'nom',
                'multiple'=>false,
                'expanded'=>false
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Reclamation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'shopbundle_reclamation';
    }


}
