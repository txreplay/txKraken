<?php

namespace AppBundle\Service;


use AppBundle\Entity\Asset;
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
        $asset = $this->em->getRepository('AppBundle:Asset')->findAll();

        if (count($parent) !== count($asset)) {
            //TODO: Empty Asset table

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
}