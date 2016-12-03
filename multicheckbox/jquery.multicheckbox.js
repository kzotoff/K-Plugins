/**
 * Plugin for converting <select multiple> to set of labeled checkbox with filtering
 *
 * @author k.zotov@gmail.com
 * @version 1.0
 * @date 2016/11/25
 */
(function($) {

	"use strict";

	$.fn.multiCheckbox = function(customOptions) {

		var options = $.extend({
		}, customOptions);

		/**
		 * Filtering the contents
		 *
		 * @param jQuery container external container to update
		 * @return void
		 */
		var applyFilter = function(container) {
			var filterString = container.find('.multicheckbox-filter-input').val();
			container.find('.multicheckbox-contents').find('label').each(function() {
				if (this.innerText.toUpperCase().indexOf(filterString.toUpperCase()) >= 0) {
					$(this).css('display', 'block');
				} else {
					$(this).css('display', 'none');
				}
			});
		};

		/**
		 * Total/checked/visible counters
		 *
		 * @param jQuery container external container to update
		 * @return void
		 */
		var updateCounters = function(container) {

			var countTotal = 0;
			var countChecked = 0;
			var countVisible = 0;

			container.find('.multicheckbox-contents').find('label').each(function() {

				countTotal ++;

				if ($(this).find('input').get(0).checked) {
					countChecked++;
				}

				if ($(this).css('display') != 'none') {
					countVisible ++;
				}

			});

			container.find('.multicheckbox-counter-checked').html(countChecked);
			container.find('.multicheckbox-counter-visible').html(countVisible);
			container.find('.multicheckbox-counter-total').html(countTotal);
		};

		return this.each(function() {

			var $source = $(this);

			var entireHTML = ' \
				<div class="multicheckbox"> \
					<div class="multicheckbox-helper"> \
						<div class="multicheckbox-counters"> \
							<span class="multicheckbox-counter-checked">-</span> \
							<span class="multicheckbox-counter-visible">-</span> \
							<span class="multicheckbox-counter-total">-</span> \
						</div> \
						<input class="multicheckbox-filter-input" type="text" placeholder="type to filter..." /> \
					</div> \
					<div class="multicheckbox-contents"> \
					</div> \
				</div> \
			';

			// create new structure here
			var $container = $(entireHTML).insertBefore($source);
			var $contents = $container.find('.multicheckbox-contents');

			// create elements
			$source.find('option').each(function() {
				var $newElem = $('<label><input type="checkbox" data-src-index="'+$(this).index()+'" />' + $(this).text() + '</label>');
				$contents.append( $newElem );
				if (this.selected) {
					$newElem.find('input').get(0).checked = 'checked';
				}
			});

			// add filtering
			$container.find('.multicheckbox-filter-input').on('keyup', function() {
				applyFilter($container);
				updateCounters($container);
			});

			// create projection
			$contents.on('click', 'input[type="checkbox"]', function() {
				var $realElement = $source.find('option').get( $(this).attr('data-src-index') );
				if (this.checked) {
					$realElement.setAttribute('selected', 'selected');
				} else {
					$realElement.removeAttribute('selected');
				}
				$source.change();
				updateCounters($container);
			});

			// replace original <select>
			$container.css('width', $source.outerWidth() + 'px');
			$container.css('height', $source.outerHeight() + 'px');
			$source.css('display', 'none');
			
			// update data immediately
			updateCounters($container);

		});
	}
})(jQuery);