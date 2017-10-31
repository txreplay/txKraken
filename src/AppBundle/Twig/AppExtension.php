<?php

namespace AppBundle\Twig;


use AppBundle\Service\CurrencyService;

class AppExtension extends \Twig_Extension
{
    private $currService;

    public function __construct(CurrencyService $currService) {
        $this->currService = $currService;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('cleanAsset', array($this, 'cleanAssetFilter')),
        );
    }

    public function cleanAssetFilter($curr)
    {
        return $this->currService->cleanCurrency($curr);
    }
}