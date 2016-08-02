/**
 * @file
 * Attaches behaviors for Annotator's Auth plugin.
 */

(function ($) {

    'use strict';

    Drupal.behaviors.annotatorAuth = {
        attach: function (context, settings) {
            // Load the annotator plugin just once.
            $('html').once('annotator-auth').each(function () {
                Drupal.Annotator.annotator('addPlugin', 'Auth', {
                    tokenUrl: settings.annotator.auth.token_url,
                    token: settings.annotator.auth.token,
                    autoFetch: settings.annotator.auth.auto_fetch
                });
            });
        }
    };

})(jQuery);
