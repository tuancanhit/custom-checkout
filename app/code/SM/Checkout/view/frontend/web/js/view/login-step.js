define(
    [
        'ko',
        'uiComponent',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'Magento_Customer/js/model/customer',
        'Magento_Customer/js/customer-data',
        'mage/translate'
    ],
    function (ko, Component, _, stepNavigator, customer, customerData ,$t
    ) {
        'use strict';
        /**
         *
         * login-step - is the name of the component's .html template,
         * <Vendor>_<Module> = SM_Checkout  - is the name of the your module directory.
         *
         */

        return Component.extend({
            defaults: {
                template: 'SM_Checkout/login-step'
            },
            stepCode : 'login-step',
            stepTitle : $t('Login'),
            //add here your logic to display step
            isVisible: ko.observable(true),
            isLoggedIn: customer.isLoggedIn(),
            /**
             *
             * @returns {*}
             */
            initialize: function () {
                this._super();
                // register your step
                stepNavigator.registerStep(
                    //step code will be used as step content id in the component template
                    this.stepCode,
                    //step alias
                    null,
                    //step title value
                    this.stepTitle,
                    //observable property with logic when display step or hide step
                    this.isVisible,

                    _.bind(this.navigate, this),

                    /**
                     * sort order value
                     * 'sort order value' < 10: step displays before shipping step;
                     * 10 < 'sort order value' < 20 : step displays between shipping and payment step
                     * 'sort order value' > 20 : step displays after payment step
                     */
                    1
                );

                /**
                 * Skip step login if user logged in
                 */
                if(this.isLoggedIn){
                    window.location.hash = 'shipping';
                }

                return this;
            },

            /**
             * The navigate() method is responsible for navigation between checkout step
             * during checkout. You can add custom logic, for example some conditions
             * for switching to your custom step
             * When the user navigates to the custom step via url anchor or back button we_must show step manually here
             */
            navigate: function () {

                this.isVisible(true);
            },

            /**
             * To next step
             * @returns void
             */
            navigateToNextStep: function () {
                stepNavigator.next();
            },

            /**
             * Get lucky number from window checkout config data
             * @returns {int}
             */
            getLuckyNumber : function () {
                return window.checkoutConfig.lucky_number;
            },

            /**
             * Get game title form local storage
             * @returns {*}
             */
            getGameTitle : function () {
                return customerData.get('custom_local_storage_data')().game_title;
            }
        });
    }
);
