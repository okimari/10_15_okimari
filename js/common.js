!function(){	// limit scope
	jQuery(function($){
		var $window = $(window),
		breakPoint = 767, //ブレイクポイントの設定
		wid = $window.width(),
		resizeTimer = false,
		clickEvent = ('ontouchend' in window)? 'touchend' : 'click';

//////////////////////////////////////////////
//
//   function - parts
//
//////////////////////////////////////////////

/* change Img
*********************************************/
function changeImgSp(){
	$('.change-img').each(function(){
		$(this).attr("src",$(this).attr("src").replace(/_pc\./, '_sp.'));
	});
}
function changeImgPc(){
	$('.change-img').each(function(){
		$(this).attr("src",$(this).attr("src").replace(/_sp\./, '_pc.'));
	});
}

/* sp menu
*********************************************/
function spMenuSp(){
	$('.sp-menu-btn').click(function () {
		winHeight = $window.height();
		$('.l-body').toggleClass('is-fixed');
		$(this).stop().toggleClass('is-opend');
		$('.globalnavi').stop().fadeToggle().css('height', winHeight);
		return false;
	});
}
function spMenuPc(){
	$('.sp-menu-btn').removeClass('is-opend');
	$('.globalnavi').removeAttr('style');
	$('.l-body').removeClass('is-fixed');
}

//////////////////////////////////////////////
//
//   Common - PC / SP
//
//////////////////////////////////////////////

/* smooth scroll 
*********************************************/
$('.anchor').click(function(){
	var speed = 400;
	var href= $(this).attr("href");
	var target = $(href == "#" || href == "" ? 'html' : href);
	var position = target.offset().top;
	$("html, body").animate({scrollTop:position}, speed, "swing");
	return false;
});

$(window).on('load', function() {
	var url = $(location).attr('href');
	if(url.indexOf("?id=") != -1){
		var id = url.split("?id=");
		var $target = $('#' + id[id.length - 1]);
		if($target.length){
			var pos = $target.offset().top -80;
			$("html, body").animate({scrollTop:pos}, 500);
		}
	}
});

/* gallery modal movie
*********************************************/
$('.js-movie').magnificPopup({
	type: 'iframe',
	removalDelay: 200,
	preloader: false,
	fixedContentPos: false,
});

/* gallery slide
*********************************************/
$('.gallery-slide').slick({
	arrows: false,
	autoplay: true,
	autoplaySpeed: 3000,
	centerMode: true,
	// cssEase: 'linear',
	speed: 600,
	variableWidth: true,
	arrows: true,
	responsive: [
		{
			breakpoint: 768,
			settings: {
				// speed: 8000,
			}
		}
	]
});

/* gallery instagram
*********************************************/
var root;
var scripts = document.getElementsByTagName("script");
var i = scripts.length;
while (i--) {
	var match = scripts[i].src.match(/(^|.*\/)common\.js$/);
	if (match) {
		root = match[1];
		break;
	}
}
var theme_url = root.replace( 'js/', '' ) + 'include/instagram.php';

var $container = $(".photo__items");
var html = "";

$.ajax({
	url: theme_url,//PHPファイルURL
	type:"POST",
	dataType: "json"
})

.done(function(data){
	//通信成功時の処理
	$.each(data.data,function(i,item){
		var imgurl = item.images.standard_resolution.url; //低解像度の画像のURLを取得
		var link = item.link; //リンクを取得
		html += '<li class="photo__item"><a href="' + link + '" target="_blank"><img src="' + imgurl + '" alt="インスタグラム画像"></a></li>';
	});
}).fail(function(){
	//通信失敗時の処理
	html = "<li>画像を取得できません。</li>";
}).always(function(){
	//通信完了時の処理
	$container.html(html);
});


/* faq slideToggle
*********************************************/
$('.faq__question').click(function(){
	$(this).next().slideToggle(300);
	$(this).toggleClass('is-open');
});

/* faq tab
*********************************************/
$('.faq-tab__inner').click(function(){
	var activeFaq = $(this).attr('href');
	$('.faq__content').removeClass('is-active')
	$(activeFaq).addClass('is-active')
	$('.faq-tab__inner').removeClass('is-active')
	$(this).addClass('is-active')
	return false;
});

/* scroll In animation
*********************************************/
function scrollanimation($height){
	$(window).scroll(function (){
		var scroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		$('.scrollin').each(function(){
			var elemPos = $(this).offset().top;
			if (scroll > elemPos - windowHeight + $height){
				$(this).addClass('is-visible');
			}
		});
	});
}

//////////////////////////////////////////////
//
//   Only Pc Size Processing
//
function pcSizeOnly(){
//////////////////////////////////////////////
changeImgPc();
spMenuPc();
scrollanimation(300);

//////////////////////////////////////////////
}
//   Only Sp Size Processing
//
function spSizeOnly(){
//////////////////////////////////////////////
changeImgSp();
spMenuSp();
scrollanimation(200);

//////////////////////////////////////////////
}
//   Break Point & Window Resize
//
//////////////////////////////////////////////
		function descriminateBp(){
			wid = $window.width();
			if(wid <= breakPoint){
				spSizeOnly();
			}else if(wid > breakPoint){
				pcSizeOnly();
			}
		}
		descriminateBp();
		$window.resize(function() {
			if(wid > $window.width() || wid < $window.width()){
				if (resizeTimer !== false) {
					clearTimeout(resizeTimer);
				}
				resizeTimer = setTimeout(descriminateBp, 200);
			}
		});
	});
}();