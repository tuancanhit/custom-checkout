define([
    'jquery',
    'ko',
    'uiComponent'],
    function ($, ko, Component) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'SM_Checkout/shipping/shipping-note' // define component template (html)
        },
        /**
         * Init
         * @returns {exports}
         */
        initialize: function () {
            this._super();
            return this;
        }
    });
});