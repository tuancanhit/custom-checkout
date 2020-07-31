var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'SM_Checkout/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'SM_Checkout/js/view/shipping-payment-mixin': true
            }
        }
    }
};

// If your new step is the first step, you have to create mixins for the payment and shipping steps.
// Otherwise two steps will be activated on loading of the checkout.


