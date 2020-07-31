<?php

namespace SM\Checkout\Model\DataProvider;

/**
 * Class Config
 * @package SM\Checkout\Model\DataProvider
 */
class Config implements \Magento\Checkout\Model\ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            'lucky_number' => rand(1000, 9000)
        ];
    }
}
