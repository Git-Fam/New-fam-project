$(function () {


	// front-appeal slider (Swiper)
	if (typeof Swiper !== 'undefined' && document.querySelector('.p-front-appeal__swiper')) {
		var slidesLen = document.querySelectorAll('.p-front-appeal__swiper .swiper-slide').length || 0;
		var frontAppealSwiper = new Swiper('.p-front-appeal__swiper', {
			centeredSlides: true,
			centeredSlidesBounds: true,
			slidesPerView: 1.2,
			spaceBetween: 20,
			loop: true,
			loopedSlides: slidesLen,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
			observer: true,
			observeParents: true,
      pagination: {
        el: '.p-front-appeal__swiper .swiper-pagination',
        clickable: true,
      },
			// responsive spacing
			breakpoints: {
				768: {
					slidesPerView: 1.5,
					spaceBetween: 40
				},
			}
		});

		// endress marquee is handled with CSS-only implementation
	}
});


// mobile: turn .p-archive into a Swiper slider on small screens
(function(){
	var archiveSwiper = null;
	var debounceTimer = null;

	function initOrDestroyArchive() {
		var isMobile = window.matchMedia('(max-width: 828px)').matches;
		var $archive = $('.p-archive');
		if (!$archive.length) return;

		if (isMobile) {
			if ($archive.hasClass('swiper-initialized') || archiveSwiper) return;

			// add pagination container
			if (!$archive.find('.p-archive-pagination').length) {
				$archive.after('<div class="p-archive-pagination swiper-pagination"></div>');
			}

			// prepare DOM for Swiper
			if (!$archive.hasClass('swiper')) {
				$archive.addClass('swiper');
				$archive.wrapInner('<div class="swiper-wrapper"></div>');
				$archive.find('.p-archive__item').addClass('swiper-slide');
			}

			// allow specifying per-item width using data attribute: data-slide-width="220px" or data-slide-width="220"

			archiveSwiper = new Swiper('.p-archive', {
				slidesPerView: 'auto',
				spaceBetween: 0,
				loop: true,
				// autoplay: {
				// 	delay: 3000,
				// 	disableOnInteraction: false,
				// },
				pagination: {
					el: '.p-archive-pagination',
					clickable: true
				},
			});
		} else {
			if (archiveSwiper) {
				try { archiveSwiper.destroy(true, true); } catch(e) {}
				archiveSwiper = null;
			}

			if ($archive.hasClass('swiper')) {
				$archive.removeClass('swiper');
				$archive.find('.p-archive__item').removeClass('swiper-slide');
				var $wrapper = $archive.find('.swiper-wrapper');
				if ($wrapper.length) {
					$wrapper.children().appendTo($archive);
					$wrapper.remove();
				}
				$archive.siblings('.p-archive-pagination').remove();
			}
		}
	}

	function onResize() {
		clearTimeout(debounceTimer);
		debounceTimer = setTimeout(initOrDestroyArchive, 150);
	}

	$(window).on('load resize', onResize);
	// initial call
	$(initOrDestroyArchive);

	// responsive p-event-list: Swiper on desktop, native horizontal scroll on small screens
	if (document.querySelector('.p-event-list')) {
		var eventListSwiper = null;

		function initOrUpdateEventList() {
			var el = document.querySelector('.p-event-list');
			if (!el) return;
			var isMobile = window.matchMedia('(max-width: 828px)').matches;

			if (isMobile) {
				// destroy swiper if exists
				if (eventListSwiper) {
					try { eventListSwiper.destroy(true, true); } catch (e) {}
					eventListSwiper = null;
				}

				// unwrap swiper DOM if present
				if (el.classList.contains('swiper')) {
					el.classList.remove('swiper');
					var wrapper = el.querySelector('.swiper-wrapper');
					if (wrapper) {
						var children = Array.prototype.slice.call(wrapper.children);
						children.forEach(function(c){ el.appendChild(c); });
						wrapper.remove();
					}
					el.querySelectorAll('.p-event-list__item').forEach(function(i){ i.classList.remove('swiper-slide'); });
				}

				el.classList.add('is-scrollable');
			} else {
				el.classList.remove('is-scrollable');

				if (typeof Swiper === 'undefined') return;
				if (eventListSwiper) return;

				// prepare DOM for Swiper if needed
				if (!el.classList.contains('swiper')) {
					el.classList.add('swiper');
					var wrapper = document.createElement('div');
					wrapper.className = 'swiper-wrapper';
					while (el.firstChild) wrapper.appendChild(el.firstChild);
					el.appendChild(wrapper);
					el.querySelectorAll('.p-event-list__item').forEach(function(i){ i.classList.add('swiper-slide'); });

					// ensure scrollbar element exists for desktop interactions
					if (!el.querySelector('.swiper-scrollbar')) {
						var sb = document.createElement('div');
						sb.className = 'swiper-scrollbar';
						el.appendChild(sb);
					}
				}

				eventListSwiper = new Swiper('.p-event-list', {
					centeredSlides: true,
					centeredSlidesBounds: true,
					slidesPerView: 'auto',
					spaceBetween: 0,
					loop: true,
					// allow mouse wheel scrolling on desktop
					mousewheel: {
						forceToAxis: true,
						releaseOnEdges: true,
					},
					// show draggable scrollbar for non-drag interaction
					scrollbar: {
						el: '.p-event-list .swiper-scrollbar',
						draggable: true,
						hide: false,
					},
					breakpoints: {
						768: {
							slidesPerView: 'auto',
							spaceBetween: 40
						}
					}
				});
			}
		}

		window.addEventListener('resize', function(){ clearTimeout(window._eventListTimer); window._eventListTimer = setTimeout(initOrUpdateEventList, 150); });
		window.addEventListener('load', initOrUpdateEventList);
		initOrUpdateEventList();
	}

	// 画面をスクロールしたら p-header の p-header--front を削除する
	$(window).on('scroll', function() {
		// only toggle front class on actual front page
		if (!document.body.classList.contains('home') && !document.body.classList.contains('front-page')) return;

		if ($(this).scrollTop() > 0) {
			$('.p-header').removeClass('p-header--front');
		} else {
			$('.p-header').addClass('p-header--front');
		}
	});

	// js-header-trg をクリックしたら js-header-trg に is-active を付与し、p-header に is-open を付与する
	$('.js-header-trg').on('click', function(e) {
		if (e) {
			e.preventDefault && e.preventDefault();
			e.stopPropagation && e.stopPropagation();
			if (typeof e.stopImmediatePropagation === 'function') e.stopImmediatePropagation();
		}
		var $btn = $(this);
		$btn.toggleClass('is-active');
		$('.p-header').toggleClass('is-open');
		$('.p-header-overlay').toggleClass('is-active');

		// Preserve scroll position when locking body
		if (!document.body.classList.contains('is-fixed')) {
			var scrollY = window.scrollY || window.pageYOffset || 0;
			document.body.dataset.scrollY = scrollY;
			document.body.style.top = '-' + scrollY + 'px';
			document.documentElement.classList.add('is-fixed');
			document.body.classList.add('is-fixed');
		} else {
			// restore
			document.documentElement.classList.remove('is-fixed');
			document.body.classList.remove('is-fixed');
			var prev = document.body.dataset.scrollY ? parseInt(document.body.dataset.scrollY, 10) : 0;
			document.body.style.top = '';
			if (typeof window.scrollTo === 'function') window.scrollTo({ top: prev, left: 0, behavior: 'auto' });
			delete document.body.dataset.scrollY;
		}

		return false;
	});

	// p-header-overlay をクリックしたら js-header-trg の is-active を削除し、p-header の is-open を削除する
	$('.p-header-overlay').on('click', function() {
		$('.js-header-trg').removeClass('is-active');
		$('.p-header').removeClass('is-open');
		$(this).removeClass('is-active');

		// restore scroll position when overlay closed
		document.documentElement.classList.remove('is-fixed');
		document.body.classList.remove('is-fixed');
		var prev = document.body.dataset.scrollY ? parseInt(document.body.dataset.scrollY, 10) : 0;
		document.body.style.top = '';
		if (typeof window.scrollTo === 'function') window.scrollTo({ top: prev, left: 0, behavior: 'auto' });
		delete document.body.dataset.scrollY;
	});

	
	// js-load-target に is-show を付与し、MW WP Form の自動挿入 <br> を削除する処理
	function runLoadTasks() {
		$('.js-load-target').each(function() {
			$(this).addClass('is-show');
		});

		// Remove automatic <br> inserted by MW WP Form
		if (document.querySelectorAll) {
			document.querySelectorAll('.mw_wp_form br, .mwform-checkbox-field br, .mwform-radio-field br, .mwform-checkbox-field-text br').forEach(function(el){ el.parentNode && el.parentNode.removeChild(el); });
		}
	}

	// Run immediately (for SPA-like or early DOM) and also on window load
	runLoadTasks();
	$(window).on('load', runLoadTasks);

		// Fade-in KV images after full page load
		window.addEventListener('load', function(){
			try {
				document.querySelectorAll('.js-kv-load').forEach(function(el){ el.classList.add('is-loaded'); });
			} catch (e) {}
		});
	

	// js-scroll-target クラスを持つ要素全てに対して、画面に表示されたら、js-scroll-target クラスを持つ要素に is-show クラスを付与する
	$(window).on('scroll', function() {
		$('.js-scroll-target').each(function() {
			var target = $(this).offset().top;
			var scroll = $(window).scrollTop();
			var windowHeight = $(window).height();
			if (scroll > target - windowHeight + 100) {
				$(this).addClass('is-show');
			} else {
				$(this).removeClass('is-show');
			}
		});

		// 画面をスクロールして p-kv__overlay があったら p-kv__overlay のopacity を スクロール量に合わせて変化させる
		var scroll = $(window).scrollTop();
		var overlay = $('.p-kv__overlay');
		if (overlay.length) {
			var opacity = 0 + scroll / 300;
			if (opacity > 1) opacity = 1;
			overlay.css('opacity', opacity);
		}

		// js-footer-hide クラスを持つ要素全てに対して、画面をスクロールして footer までスクロールしたら、js-footer-hide クラスを持つ要素に is-hide クラスを付与する
		$('.js-footer-hide').each(function() {
			var target = $('.p-footer-top').offset().top;
			var scroll = $(window).scrollTop();
			var windowHeight = $(window).height();
			if (scroll + windowHeight > target) {
				$(this).addClass('is-hide');
			} else {
				$(this).removeClass('is-hide');
			}
		});
	});


	const images = document.querySelectorAll('img');
	images.forEach(img => {
		if (!img.hasAttribute('width') && !img.hasAttribute('height')) {
			const imgLarge = new Image();
			imgLarge.src = img.src;
			imgLarge.onload = () => {
				img.setAttribute('width', imgLarge.width);
				img.setAttribute('height', imgLarge.height);
			};
		}
	});


	// .js-modal-openner をクリックしたら、data-target 属性の値を持つ .c-modal をフェードインで表示する
	$('.js-modal-openner').on('click', function(e) {
		if (e) {
			e.preventDefault && e.preventDefault();
			e.stopPropagation && e.stopPropagation();
			if (typeof e.stopImmediatePropagation === 'function') e.stopImmediatePropagation();
		}
		var target = $(this).data('target');
		if (!target) return;
		var $modal = $('#' + target);
		if (!$modal.length) return;

		$modal.fadeIn(300, function() {
			$modal.addClass('is-show');
			// lock body scroll
			var scrollY = window.scrollY || window.pageYOffset || 0;
			document.body.dataset.scrollY = scrollY;
			document.body.style.top = '-' + scrollY + 'px';
			document.documentElement.classList.add('is-fixed');
			document.body.classList.add('is-fixed');
		});
	});

	// .js-modal-close をクリックしたら、親の .c-modal をフェードアウトで非表示にする
	$('.js-modal-close').on('click', function(e) {
		if (e) {
			e.preventDefau4lt && e.preventDefault();
			e.stopPropagation && e.stopPropagation();
			if (typeof e.stopImmediatePropagation === 'function') e.stopImmediatePropagation();
		}
		var $modal = $(this).closest('.c-modal');
		if (!$modal.length) return;

		$modal.fadeOut(300, function() {
			$modal.removeClass('is-show');
			// restore scroll position when modal closed
			document.documentElement.classList.remove('is-fixed');
			document.body.classList.remove('is-fixed');
			var prev = document.body.dataset.scrollY ? parseInt(document.body.dataset.scrollY, 10) : 0;
			document.body.style.top = '';
			if (typeof window.scrollTo === 'function') window.scrollTo({ top: prev, left: 0, behavior: 'auto' });
			delete document.body.dataset.scrollY;
		});
	});

})();
