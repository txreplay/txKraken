<?php

namespace AppBundle\Controller;

use AppBundle\Service\KrakenApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Cache(expires="+ 60 seconds", smaxage="60", maxage="60")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $kraken = $this->get(KrakenApiService::class);

        return $this->render('front/index.html.twig', [
            'balances' => $kraken->getAccountBalance()->getBalanceModels(),
            'test' => $kraken->getAssets()
        ]);
    }
}
