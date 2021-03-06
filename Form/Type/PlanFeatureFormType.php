<?php

namespace Dzangocart\Bundle\SubscriptionBundle\Form\Type;

use Dzangocart\Bundle\SubscriptionBundle\Propel\PeriodQuery;
use Dzangocart\Bundle\SubscriptionBundle\Propel\UnitQuery;
use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlanFeatureFormType extends BaseAbstractType
{
    protected $locale;

    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'dzangocart_subscription',
            'data_class' => 'Dzangocart\Bundle\SubscriptionBundle\Propel\PlanFeature',
            'name' => 'dzangocart_subscription_plan_feature',
            'intention' => 'plan_feature',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value', TextType::class, array(
            'label' => false,
        ));

        $builder->add('unit', 'model', array(
            'class' => 'Dzangocart\Bundle\SubscriptionBundle\Propel\Unit',
            'property' => 'name',
            'query' => $this->getUnitQuery(),
            'label' => false,
            'required' => false,
        ));

        $builder->add('period', 'model', array(
            'class' => 'Dzangocart\Bundle\SubscriptionBundle\Propel\Period',
            'property' => 'name',
            'query' => $this->getPeriodQuery(),
            'label' => false,
            'required' => false,
        ));
    }

    protected function getUnitQuery()
    {
        return UnitQuery::create()
            ->joinWithI18n($this->getLocale());
    }

    protected function getPeriodQuery()
    {
        return PeriodQuery::create()
            ->joinWithI18n($this->getLocale());
    }
}
