<?php

namespace SM\Checkout\Observer;


/**
 * Class SaveShippingNoteToSaleOrder
 * @package SM\Checkout\Observer
 */
class SaveShippingNoteToSaleOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $order->setData('shipping_note', $quote->getShippingNote());
        $order->save();
        return $this;
    }
}
