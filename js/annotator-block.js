/**
 * @file
 * Attaches behaviors for Annotator.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorBlock = {
        attach: function (context, settings) {
            $(context).find(settings.annotatorBlock.selector)
                .css('border', '1px solid green')
                .once('annotator').each(function () {
                Drupal.Annotator = $(settings.annotatorBlock.selector).annotator();
            });
        }
    };

})(jQuery);
