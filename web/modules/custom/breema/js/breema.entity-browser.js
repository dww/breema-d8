/**
 * @file
 * Defines the behavior of the Breema entity browser views.
 */

(function ($) {

  "use strict";

  /**
   * Update the class of a row based on the status of a checkbox.
   *
   * @param {object} $row
   * @param {object} $input
   */
  function updateClasses($row, $input) {
    $row[$input.prop('checked') ? 'addClass' : 'removeClass']('checked');
  }

  /**
   * Attaches the behavior of the media entity browser view.
   */
  Drupal.behaviors.breemaEntityBrowserView = {
    attach: function (context, settings) {
      // Run through each row to add the default classes.
      $('.entity-browser-row', context).each(function() {
        var $row = $(this);
        var $input = $row.find('.views-field-entity-browser-select input');
        updateClasses($row, $input);
      });
      // Add a checked class when clicked.
      $('.entity-browser-row', context).once().click(function () {
        var $row = $(this);
        var $input = $row.find('.views-field-entity-browser-select input');
        $input.prop('checked', !$input.prop('checked'));
        updateClasses($row, $input);
      });
    }
  };

}(jQuery, Drupal));