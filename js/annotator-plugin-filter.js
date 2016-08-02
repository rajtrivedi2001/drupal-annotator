/**
 * @file
 * Attaches behaviors for Annotator's Filter plugin.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorFilter = {
        attach: function (context, settings) {
            // Load the annotator plugin just once.
            $('html').once('annotator-filter').each(function () {
                Drupal.Annotator.annotator('addPlugin', 'Filter');
            });
        }
    };

})(jQuery);
