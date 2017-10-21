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

    public function __construct($apiKey, $apiSecret, EntityManager $em)
    {
        parent::__construct($apiKey, $apiSecret,'0','https://api.kraken.com/');

        $this->em = $em;
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
    }

    public function getTradesHistory($type = 'all', $trades = false, $start = null, $end = null, $ofs = null)
    {
        $parent = parent::getTradesHistory($type, $trades, $start, $end, $ofs);
        $trade_history = $this->em->getRepository('AppBundle:Trade')->findAll();

        if ($parent->getCount() !== count($trade_history)) {
            //TODO: Check differences

            foreach ($parent->getTrades() as $item) {
                $trade = new Trade();
                $trade->setTxid($item->getOrdertxid());
                $trade->setPair($item->getPair());
                $trade->setCurr1('null');
                $trade->setCurr2('null');
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
}