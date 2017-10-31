<?php

namespace AppBundle\Controller;

use AppBundle\Service\CurrencyService;
use AppBundle\Service\KrakenApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        $curr = $this->get(CurrencyService::class);

        $balances = $kraken->getAccountBalance()->getBalanceModels();
        $total_balance = $kraken->getTradeBalance('currency', 'EUR')->getEquivavlentBalance();
        $to_ticker = [];
        foreach ($balances as $balance) {
            if ($balance->getAssetName() === 'DASH') {
                $to_ticker[] = $balance->getAssetName().'EUR';
            } elseif ($balance->getAssetName() !== 'ZEUR' && $balance->getAssetName() !== 'ZUSD') {
                $to_ticker[] = $balance->getAssetName().'ZEUR';
            }
        }
        $ticker = $kraken->getTicker($to_ticker);

        return $this->render('front/index.html.twig', [
            'balances' => $balances,
            'total_balance' => $total_balance,
            'ticker' => $ticker,
            'eur_usd' => $curr->convertUsdToEur()
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

    /**
     * @Route("/test", name="app_test")
     * @Cache(expires="+ 60 seconds", smaxage="60", maxage="60")
     * @Method({"GET"})
     */
    public function testAction()
    {
        $kraken = $this->get(KrakenApiService::class);
        $curr = $this->get(CurrencyService::class);
        $curr->convertUsdToEur();

        return true;
    }
}
