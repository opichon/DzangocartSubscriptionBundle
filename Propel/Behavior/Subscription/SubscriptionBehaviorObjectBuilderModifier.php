<?php

namespace Dzangocart\Bundle\SubscriptionBundle\Propel\Behavior\Subscription;

class SubscriptionBehaviorObjectBuilderModifier
{
    protected $behavior, $table, $builder;

    public function __construct($behavior)
    {
        $this->behavior = $behavior;
        $this->table = $behavior->getTable();
    }

    public function objectMethods($builder)
    {
        $this->builder = $builder;
        $script = '';
        $script .= $this->addIsExpired();
        $script .= $this->addIsTrial();

        $this->builder->declareClasses('Propel\PropelBundle\Util\PropelInflector');
        $script .= $this->add__Call();

        if (!$this->table->getBehavior('domainsubscription')) {
            $this->builder->declareClasses('Symfony\Component\Validator\Constraints\NotNull');
            $script .= $this->addLoadValidatiorMetadata();
        }

        return $script;
    }

    protected function addIsExpired()
    {
        return $this->behavior->renderTemplate('objectIsExpired', array(
            'column_name' => $this->table->getColumn($this->behavior->getParameter('expires_at_column'))->getPhpName(),
        ));
    }

    protected function addIsTrial()
    {
        return $this->behavior->renderTemplate('objectIsTrial', array(
            'column_name' => $this->table->getColumn($this->behavior->getParameter('trial_expires_at_column'))->getPhpName(),
        ));
    }

    protected function addLoadValidatiorMetadata()
    {
        return $this->behavior->renderTemplate('objectLoadValidatorMetadata', array(
            'plan_id_column' => $this->table->getBehavior('subscription')->getParameter('plan_id_column'),
        ));
    }

    protected function add__Call()
    {
        return $this->behavior->renderTemplate('objectCall', array());
    }
}
