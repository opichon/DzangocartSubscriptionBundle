<?php

namespace Dzangocart\Bundle\SubscriptionBundle\Controller;

use Dzangocart\Bundle\SubscriptionBundle\Propel\FeatureQuery;
use Dzangocart\Bundle\SubscriptionBundle\Propel\PlanQuery;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MatrixController extends Controller
{
   /**
    * @Route("/matrix", name = "dzangocart_subscription_matrix")
    * @Template()
    */
    public function indexAction(Request $request)
    {
        $plans = PlanQuery::create()
            ->joinWithI18n($this->getRequest()->getLocale())
            ->orderByRank()
            ->getActive()
            ->find();

        $plan_features = FeatureQuery::create()
            ->joinWithI18n($this->getRequest()->getLocale())
            ->orderByRank()
            ->find();

        return array(
            'plans' => $plans,
            'planfeatures' => $plan_features
        );
    }
}
