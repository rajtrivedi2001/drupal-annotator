/**
 * @file
 * Attaches behaviors for Annotator's Markdown plugin.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorMarkdown = {
        attach: function (context, settings) {
            // Load the annotator plugin just once.
            $('html').once('annotator-markdown').each(function () {
                Drupal.Annotator.annotator('addPlugin', 'Markdown');
            });
        }
    };

})(jQuery);
