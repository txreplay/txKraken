<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;

class CurrencyService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function dissociatePair($pair)
    {
        $crypto_list = $this->cryptoList();
        $curr_1 = substr($pair, 0, -4);
        $curr_2 = substr($pair,  -4);

        // Check for crypto name is length of 4 (DASH)
        if (!in_array($curr_1, $crypto_list)) {
            $curr_1 = substr($pair, 0, -3);
            $curr_2 = substr($pair,  -3);
        } else {
            $curr_1 = substr($curr_1, 1, 3);
            $curr_2 = substr($curr_2,  -3);
        }

        return [
            0 => $curr_1,
            1 => $curr_2
        ];
    }

    public function cleanCurrency($curr)
    {
        return array_search($curr, $this->cryptoList());
    }

    public function cryptoList()
    {
        $assets = $this->em->getRepository('AppBundle:Asset')->findAll();

        $cryptoList = [];
        foreach ($assets as $asset) {
            $cryptoList[$asset->getAltname()] = $asset->getAssetName();
        }

        return $cryptoList;
    }

    public function convertUsdToEur()
    {
        $client = new Client();
        $request = $client->request('GET', 'http://api.fixer.io/latest?base=USD');

        $result = json_decode($request->getBody()->getContents());

        return $result->rates->EUR;
    }
}