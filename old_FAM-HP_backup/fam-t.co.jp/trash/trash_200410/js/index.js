$(function(){

	$("img.rollover").mouseover(function(){
		$(this).attr("src",$(this).attr("src").replace(/^(.+)(\.[a-z]+)$/, "$1_on$2"));
	}).mouseout(function(){
		$(this).attr("src",$(this).attr("src").replace(/^(.+)_on(\.[a-z]+)$/, "$1$2"));
	}).each(function(){
		$("<img>").attr("src",$(this).attr("src").replace(/^(.+)(\.[a-z]+)$/, "$1_on$2"));
	});

	// ページのフェードイン
	$('.sbox').fadeMover({
		'inSpeed': 1800,
		'inDelay': 330
	});
	// ページのフェードアウト
	$('sbox').fadeMover();

	$(".gotoTopBtn").click(function () {
		$('html,body').animate({ scrollTop: 0 }, 'slow');
		return false;
	});

	// Scroll開始
	$(window).on('scroll',function(){
		scrollpx = $(this).scrollTop();
		var sp = 0.3;
		// menu部分の動き
		if(scrollpx < 180){
			$("nav").css({
				"position":"",
				"padding":"0px"
			});
		}else{
			$("nav").css({
				"position":"fixed",
				"background-color":"#fff",
				"top":"0px",
				"padding-top":"12px",
				"padding-bottom":"10px"
			});
		}
		// asideの動き
		if(!$("aside").hasClass("privacyAside")){
			if(scrollpx < 731){
				$("aside").css({
					"margin-top":"38px",
					"top": "0px"
				});
			}else{
				posiY = (scrollpx - 731+36)+"px";
				$("aside").css({
					"top":posiY,
					"margin-top":"0px"
				});
			}
		}else{
			if(scrollpx < 250){
				$("aside").css({
					"margin-top":"38px",
					"top": "0px"
				});
			}else{
				posiY = (scrollpx - 250+33)+"px";
				$("aside").css({
					"top":posiY,
					"margin-top":"0px"
				});
			}
		}
	});

});
