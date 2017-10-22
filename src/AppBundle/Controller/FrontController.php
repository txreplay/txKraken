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
        $balances = $kraken->getAccountBalance()->getBalanceModels();

        return $this->render('front/index.html.twig', [
            'balances' => $balances,
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
        $trades = $kraken->getTradesHistory();

        return $this->render('front/trades.html.twig', [
            'trades' => $trades
        ]);
    }
}
