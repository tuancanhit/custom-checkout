<?php

namespace SM\Checkout\Model\DataProvider;

/**
 * Class LocalData
 * @package SM\Checkout\Model\DataProvider
 */
class LocalData implements \Magento\Customer\CustomerData\SectionSourceInterface
{
    /**
     * @return array
     */
    public function getSectionData()
    {
        return [
          'game_title' => 'Lucky number today is '
        ];
    }
}
