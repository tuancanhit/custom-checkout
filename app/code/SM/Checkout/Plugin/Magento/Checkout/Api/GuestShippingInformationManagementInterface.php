<?php

namespace SM\Checkout\Plugin\Magento\Checkout\Api;

/**
 * Class GuestShippingInformationManagementInterface
 * @package SM\Checkout\Plugin\Magento\Checkout\Api
 */
class GuestShippingInformationManagementInterface
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @var \Magento\Quote\Model\QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $cartRepository;

    /**
     * GuestShippingInformationManagementInterface constructor.
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     * @param \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
     * @param \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface
     */
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->cartRepository = $cartRepositoryInterface;
    }

    /**
     * @param \Magento\Checkout\Api\GuestShippingInformationManagementInterface $guestShippingInformationManagementInterface
     * @param int $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Api\GuestShippingInformationManagementInterface $guestShippingInformationManagementInterface,
        $cartId, //cartId get from url
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation // get from data post
    ) {
        if (!$extensionAttributes = $addressInformation->getExtensionAttributes()) {
            return [$cartId, $addressInformation];
        }

        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        $quote = $this->cartRepository->getActive($quoteIdMask->getQuoteId());

        $quote->setData('shipping_note', $extensionAttributes->getShippingNote());
        $quote->save();

        return [$cartId, $addressInformation];
    }
}
