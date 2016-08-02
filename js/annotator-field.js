/**
 * @file
 * Attaches behaviors for Annotator.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorField = {
        attach: function (context, settings) {
            $(context).find(settings.annotatorField.selector)
                .css('border', '1px solid red')
                .once('annotator').each(function () {
                Drupal.Annotator = $(settings.annotatorField.selector).annotator();
                Drupal.Annotator.Plugins = {};
            });
        }
    };

})(jQuery);
