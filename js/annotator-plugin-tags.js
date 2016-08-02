/**
 * @file
 * Attaches behaviors for Annotator's Tags plugin.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorTags = {
        attach: function (context, settings) {
            // Load the annotator plugin just once.
            $('html').once('annotator-tags').each(function () {
                Drupal.Annotator.annotator('addPlugin', 'Tags');
            });
        }
    };

})(jQuery);
