/**
 * @file
 * Attaches behaviors for Annotator's Store plugin.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorStore = {
        attach: function (context, settings) {
            // Load the annotator plugin just once.
            $('html').once('annotator-store').each(function () {
                Drupal.Annotator.annotator('addPlugin', 'Store', {
                });
            });
        }
    };

})(jQuery);
