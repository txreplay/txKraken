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
     * @Route("/", name="app_homepage")
     * @Cache(expires="+ 60 seconds", smaxage="60", maxage="60")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $kraken = $this->get(KrakenApiService::class);

        return $this->render('front/index.html.twig', [
            'balances' => $kraken->getAccountBalance()->getBalanceModels(),
            'test' => $kraken->getServerTime()
        ]);
    }

    /**
     * @Route("/trades", name="app_trades")
     * @Cache(expires="+ 60 seconds", smaxage="60", maxage="60")
     * @Method({"GET"})
     */
    public function tradesAction()
    {
        $kraken = $this->get(KrakenApiService::class);
        $api_trades = $kraken->getTradesHistory();

        return $this->render('front/trades.html.twig', [
            'api_trades' => $api_trades
        ]);
    }
}
