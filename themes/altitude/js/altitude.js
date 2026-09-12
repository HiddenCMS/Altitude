(function($){
	'use strict';

	$(function(){
		var $toggle = $('.altitude-navigation-toggle');
		var $content = $('#altitude-navigation-content');
		var $backdrop = $('.altitude-navigation-backdrop');
		var $navigation = $('.altitude-navigation');
		var $navigationSpacer = $('<div class="altitude-navigation-spacer" aria-hidden="true"></div>');
		var $top = $('.altitude-back-to-top');
		var $submenuParents = $('.altitude-navigation .nav-item').has('> .nav.flex-column');
		var isMobile = function(){ return window.innerWidth <= 860; };
		var navigationTop = $navigation.length ? $navigation.offset().top : 0;
		var lastScrollY = window.scrollY;
		var scrollTicking = false;

		if ($navigation.length)
		{
			$navigation.after($navigationSpacer);
		}

		var updateNavigation = function(){
			if (!$navigation.length)
			{
				return;
			}

			var scrollY = window.scrollY;
			var navigationHeight = $navigation.outerHeight();
			var isPastNavigation = scrollY > navigationTop;
			var isMenuOpen = $('body').hasClass('altitude-menu-open');
			var isScrollingDown = scrollY > lastScrollY + 3;
			var isScrollingUp = scrollY < lastScrollY - 3;

			$navigation.toggleClass('is-fixed', isPastNavigation);
			$navigationSpacer.height(navigationHeight).toggleClass('is-active', isPastNavigation);

			if (!isPastNavigation || isMenuOpen || isScrollingUp)
			{
				$navigation.removeClass('is-hidden');
			}
			else if (isScrollingDown && scrollY > navigationTop + navigationHeight)
			{
				$navigation.addClass('is-hidden');
				closeSubmenus();
			}

			lastScrollY = scrollY;
			scrollTicking = false;
		};

		var requestNavigationUpdate = function(){
			if (!scrollTicking)
			{
				scrollTicking = true;
				window.requestAnimationFrame(updateNavigation);
			}
		};

		var closeSubmenus = function(){
			$submenuParents.removeClass('is-submenu-open');
			$submenuParents.children('.altitude-submenu-toggle').attr('aria-expanded', 'false');
		};

		var closeMenu = function(){
			$toggle.attr('aria-expanded', 'false');
			$content.removeClass('is-open has-open-submenu');
			$('body').removeClass('altitude-menu-open');
			closeSubmenus();
		};

		$submenuParents.each(function(){
			var $item = $(this);
			var $link = $item.children('.nav-link').first();
			var $submenu = $item.children('.nav.flex-column').first();
			var title = $.trim($link.find('.nav-link-title, .hidden-xs').first().text()) || $.trim($link.text());
			var parentUrl = $link.attr('data-parent-url');

			$item.addClass('has-submenu');
			$link.attr('aria-haspopup', 'true').removeAttr('aria-expanded');
			$link.children('.fa-angle-down').remove();

			if (parentUrl){
				$link.attr('href', parentUrl).removeAttr('data-toggle');
			}

			$('<button type="button" class="altitude-submenu-toggle"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>')
				.attr('aria-label', 'Ouvrir le sous-menu '+title)
				.attr('aria-expanded', 'false')
				.insertAfter($link);

			$('<li class="altitude-submenu-back"><button type="button"><i class="fas fa-chevron-left" aria-hidden="true"></i><span class="sr-only">Retour</span></button></li>')
				.prependTo($submenu);
		});

		$toggle.on('click', function(){
			var open = $toggle.attr('aria-expanded') === 'true';

			if (open){
				closeMenu();
			}
			else {
				$content.scrollTop(0);
				$toggle.attr('aria-expanded', 'true');
				$content.addClass('is-open');
				$('body').addClass('altitude-menu-open');
				$navigation.removeClass('is-hidden');
			}
		});

		$('.altitude-navigation').on('click', '.altitude-submenu-toggle', function(event){
			event.preventDefault();

			var $button = $(this);
			var $item = $button.parent('.nav-item');
			var open = $item.hasClass('is-submenu-open');

			if (isMobile() && !open)
			{
				$content.scrollTop(0);
				$item.children('.nav.flex-column').scrollTop(0);
			}

			$item.siblings('.is-submenu-open').removeClass('is-submenu-open').children('.altitude-submenu-toggle').attr('aria-expanded', 'false');
			$item.toggleClass('is-submenu-open', !open);
			$button.attr('aria-expanded', open ? 'false' : 'true');
			$content.toggleClass('has-open-submenu', $submenuParents.filter('.is-submenu-open').length > 0);
		}).on('click', '.altitude-submenu-back button', function(event){
			event.preventDefault();

			var $item = $(this).closest('.nav.flex-column').parent('.nav-item');
			$item.removeClass('is-submenu-open').children('.altitude-submenu-toggle').attr('aria-expanded', 'false');
			$content.toggleClass('has-open-submenu', $submenuParents.filter('.is-submenu-open').length > 0);
		});

		$backdrop.on('click', closeMenu);

		$(document).on('keydown', function(event){
			if (event.key === 'Escape' && $content.hasClass('is-open')){
				closeMenu();
				$toggle.trigger('focus');
			}
		});

		$(window).on('resize', function(){
			if (!isMobile())
			{
				closeMenu();
			}

			navigationTop = $navigationSpacer.hasClass('is-active') ? $navigationSpacer.offset().top : $navigation.offset().top;
			requestNavigationUpdate();
		}).on('scroll', function(){
			$top.toggleClass('is-visible', window.scrollY > 480);
			requestNavigationUpdate();
		});

		updateNavigation();

		$top.on('click', function(){
			window.scrollTo({top: 0, behavior: 'smooth'});
		});
	});
})(jQuery);
