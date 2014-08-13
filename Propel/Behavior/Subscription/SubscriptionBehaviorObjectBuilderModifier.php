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
        return $script;
    }

    protected function addIsExpired()
    {
        return $this->behavior->renderTemplate('objectIsExpired', array(
            'column_name' => $this->table->getColumn($this->behavior->getParameter('expires_at_column'))->getPhpName()
        ));
    }
}