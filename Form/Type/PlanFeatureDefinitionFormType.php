<?php

namespace Dzangocart\Bundle\SubscriptionBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlanFeatureDefinitionFormType extends BaseAbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'name' => 'plan_feature_definition_form',
            'translation_domain' => 'feature',
            'show_legend' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'feature.features.name'
        ));

        $builder->add('description', 'text', array(
            'label' => 'feature.features.description'
        ));

        $builder->add('submit', 'submit', array(
            'label' => 'feature.features.save'
        ));
        /*
          $builder->add('modify', 'submit', array(
          'label' => 'features.definition.modify'
          )); */
    }

    public function getName()
    {
        return "plan_feature_definition_form";
    }
}