$(function(){


var wW,	wH,	scroll;
var headerH; //ヘッダ高さ
var minheaderH = 65;
var brake = 768; //ブレイクポイント
/*selector*/
var body = $('body');
var header = $('header');
var content = $('#contentArea');
//=======================================================================
//load
$(window).load(function(){

	headerH = header.height();
	console.log(headerH);

	resizeHandler();
	scrollHandler()
	$(window).bind("resize", function(){ resizeHandler();});
	$(window).scroll(function(){scrollHandler();});


});
//load ed



//----------------------------
//resize Handler
function resizeHandler(){
	wW = $(window).width();
	wH = $(window).height();

	if(wW < brake){
		header.addClass('min');
		content.css({'padding-top' : minheaderH + 'px'})
	}else{
		header.removeClass('min');
		content.css({'padding-top' : 0 + 'px'})
	}


};

//----------------------------
//scroll Handler
function scrollHandler(){
	scroll = $(window).scrollTop();

	if(wW < brake){return false;}

	if(scroll > headerH && header.hasClass('min') == false ){
		header.addClass('min');
		content.css({'padding-top' : headerH + 'px'})
	}
	if(scroll < headerH && header.hasClass('min')){
		header.removeClass('min');
		content.css({'padding-top' : 0})
	}

};

//----------------------------
//mouseover
$(document).on('mouseover' , 'img' ,function(){
		var _img = $(this);
		_img.attr('src' , _img.attr('src').replace('_off','_on'))
});
$(document).on('mouseout' , 'img' ,function(){
		var _img = $(this);
		_img.attr('src' , _img.attr('src').replace('_on','_off'))
});

//----------------------------
//link
$(document).on('click' , '.lbx', function(){
	var _tg = $(this).find('a').attr('href');
		if($(this).find('a').attr('target')== '_blank'){
			window.open(_tg);
		}else{
			location.href = _tg;
		}
});

$('#spNavBtnOpn').click(function(){
	$('#cover').removeClass('dn');
});
$('#spNavBtnCls').click(function(){
	$('#cover').addClass('dn');
});
//----------------------------
//smooth scroll
$('a[href^=#]').click(function(){
	var speed = 600;
	var href= $(this).attr("href");
	var target = $(href == "#" || href == "" ? 'html' : href);
//	var position = target.offset().top;
//	$("html, body").animate({scrollTop:position}, speed, "swing", function(){
//	});
	return false;
});




});