/**
 * @file
 * Attaches behaviors for Annotator's Permissions plugin.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorPermissions = {
        attach: function (context, settings) {
            // Load the annotator plugin just once.
            $('html').once('annotator-permissions').each(function () {
                Drupal.Annotator.annotator('addPlugin', 'Permissions', {
                });
            });
        }
    };

})(jQuery);
