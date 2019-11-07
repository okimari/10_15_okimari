!function(){
	jQuery(function($){

/* トップページ動画：初回アクセスだけ表示
*********************************************/
var period = 14; // 有効期限日数
if($.cookie('access') == undefined) {
	$.cookie('access', 'on', { expires: period }); // cookie追加
	$('.movie__second').hide(); 
} else {
	$('.movie__first').hide(); 
}

	});
}();