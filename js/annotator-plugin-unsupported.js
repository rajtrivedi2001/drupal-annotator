/**
 * @file
 * Attaches behaviors for Annotator's Unsupported plugin.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorUnsupported = {
        attach: function (context, settings) {
            // Load the annotator plugin just once.
            $('html').once('annotator-unsupported').each(function () {
                Drupal.Annotator.annotator('addPlugin', 'Unsupported');
            });
        }
    };

})(jQuery);
