<?php

namespace Keyreal\Like2buy\Plugin;

use Magento\Catalog\Model\Product as Target;

class Product
{
    /**
     * Inject all needed components over constructor injection
     *
     * @param \Magento\Framework\Pricing\Helper\Data $pricingHelper
     */
    public function __construct(\Keyreal\Like2buy\Model\Cache\TypeImport $importCache, \Magento\Framework\Pricing\Helper\Data $pricingHelper)
    {
        $this->_importCache = $importCache;
        $this->_pricingHelper = $pricingHelper;
    }

    /**
     * Use the defined helper to format the price
     *
     * @param Target $target
     * @param $result
     * @return string
     */
    public function afterGetName(Target $target, $result)
    {
        $formattedPrice = $this->_pricingHelper->currency($target->getFinalPrice(), true, false);
        return $result . ' for ONLY ' . $formattedPrice . '!';
    }
}