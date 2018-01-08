<?php

namespace AppBundle\Service;


use AppBundle\Entity\Asset;
use AppBundle\Entity\Trade;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use HanischIt\KrakenApi\KrakenApi;

class KrakenApiService extends KrakenApi
{
    private $em;
    private $currService;

    public function __construct($apiKey, $apiSecret, EntityManager $em, $currService)
    {
        parent::__construct($apiKey, $apiSecret,'0','https://api.kraken.com/');

        $this->em = $em;
        $this->currService = $currService;
    }

    public function getAssets()
    {
        $parent = parent::getAssets()->getAssets();
        $assets = $this->em->getRepository('AppBundle:Asset')->findAll();

        if (count($parent) !== count($assets)) {
            //TODO: Check differences

            foreach ($parent as $item) {
                $asset = new Asset();
                $asset->setAclass($item->getAclass());
                $asset->setAltname($item->getAltname());
                $asset->setAssetName($item->getAssetName());
                $asset->setDecimals($item->getDecimals());
                $asset->setDisplayDecimals($item->getDisplayDecimals());

                $this->em->persist($asset);
            }

            $this->em->flush();
        }

        return $assets;
    }

    public function getTradesHistory($type = 'all', $trades = false, $start = null, $end = null, $ofs = null)
    {
        $parent = parent::getTradesHistory($type, $trades, $start, $end, $ofs);
        $trade_history = $this->em->getRepository('AppBundle:Trade')->findAll();

        if ($parent->getCount() !== count($trade_history)) {
            foreach ($trade_history as $item) {
                $this->em->remove($item);
            }
            $this->em->flush();

            $this->addTrades($parent);
        }


        return $trade_history;
    }

    private function addTrades($parent)
    {
        foreach ($parent->getTrades() as $item) {
            $trade = new Trade();
            $trade->setTxid($item->getOrdertxid());
            $trade->setPair($item->getPair());
            $pair = $this->currService->dissociatePair($item->getPair());
            $trade->setCurr1($pair[0]);
            $trade->setCurr2($pair[1]);
            $trade->setTime(new \DateTime(date('Y-m-d H:i:s', $item->getTime())));
            $trade->setType($item->getType());
            $trade->setOrderType($item->getOrdertype());
            $trade->setPrice($item->getPrice());
            $trade->setCost($item->getCost());
            $trade->setFee($item->getFee());
            $trade->setVolume($item->getVol());

            $this->em->persist($trade);
        }
        $this->em->flush();
    }
}