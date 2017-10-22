<?php


namespace AppBundle\Service;


class CurrencyService
{
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
        return [
            'XBT' => 'XXBT',
            'BTC' => 'XBTC',
            'ETH' => 'XETH',
            'ETC' => 'XETC',
            'LTC' => 'XLTC',
            'XRP' => 'XXRP',
            'DASH' => 'DASH',
            'EUR' => 'ZEUR',
            'USD' => 'ZUSD',
        ];
    }
}