(function($){
	'use strict';

	$(function(){
		var $toggle = $('.altitude-navigation-toggle');
		var $content = $('#altitude-navigation-content');
		var $top = $('.altitude-back-to-top');
		var $submenuParents = $('.altitude-navigation .nav-item').has('> .nav.flex-column');

		$submenuParents.each(function(){
			var $item = $(this);
			$item.addClass('has-submenu');
			$item.children('.nav-link').first().attr('aria-expanded', $item.hasClass('active') ? 'true' : 'false');
		});

		$toggle.on('click', function(){
			var open = $toggle.attr('aria-expanded') === 'true';
			$toggle.attr('aria-expanded', open ? 'false' : 'true');
			$content.toggleClass('is-open', !open);
		});

		$submenuParents.children('.nav-link').on('click', function(event){
			if (window.innerWidth > 860) return;

			var $item = $(this).parent();

			if (!$item.hasClass('is-submenu-open'))
			{
				event.preventDefault();
				$item.siblings('.is-submenu-open').removeClass('is-submenu-open').children('.nav-link').attr('aria-expanded', 'false');
				$item.addClass('is-submenu-open');
				$(this).attr('aria-expanded', 'true');
			}
		});

		$(window).on('resize', function(){
			if (window.innerWidth > 860)
			{
				$toggle.attr('aria-expanded', 'false');
				$content.removeClass('is-open');
				$submenuParents.removeClass('is-submenu-open').children('.nav-link').attr('aria-expanded', 'false');
			}
		}).on('scroll', function(){
			$top.toggleClass('is-visible', window.scrollY > 480);
		});

		$top.on('click', function(){
			window.scrollTo({top: 0, behavior: 'smooth'});
		});
	});
})(jQuery);
