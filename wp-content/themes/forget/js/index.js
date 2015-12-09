$(document).ready(function () {
	//显示名字邮件
	$("#comment").click(function(){
		$(".comment-show").show(500);
	});
	//ajax评论翻页
	ajacpload();
	function ajacpload(){
		$('.commentnavi a').click(function(){
			var wpurl=$(this).attr("href").split(/(\?|&)action=AjaxCommentsPage.*$/)[0];
			var commentPage = 1;
			if (/comment-page-/i.test(wpurl)) {
				commentPage = wpurl.split(/comment-page-/i)[1].split(/(\/|#|&).*$/)[0];
			} else if (/cpage=/i.test(wpurl)) {
				commentPage = wpurl.split(/cpage=/)[1].split(/(\/|#|&).*$/)[0];
			};
			//alert(commentPage);//获取页数
			var postId =$('#cp_post_id').text();
			//alert(postId);//获取postid
			var url = wpurl.split(/#.*$/)[0];
			url += /\?/i.test(wpurl) ? '&' : '?';
			url += 'action=AjaxCommentsPage&post=' + postId + '&page=' + commentPage;
			//alert(url);//看看传入参数是否正确
			var loading='<div class="commnav_loding">正在努力读取中......</div>';
			$.ajax({
				url:url,
				type: 'GET',
				beforeSend: function() {
					jQuery('.commentlist').empty().html(loading);
				},
				error: function(request) {
						alert(request.responseText);
					},
				success:function(data){
					var responses=data.split('<!--winysky-AJAX-COMMENT-PAGE-->');
					$('.commentlist').empty().html(responses[0]).hide().fadeIn('slow');
					$('.commentnavi').empty().html(responses[1]);
					ajacpload();//自身重载一次
					$('.commentlist img').lazyload({effect : "fadeIn"});
					$body.animate( { scrollTop: $('#comments').offset().top - 200}, 1000);
				}//返回评论列表顶部
			});
			return false;
		});
	}

	//+1
	$.fn.postLike = function() {
		if ($(this).hasClass('done')) {
			return false;
		} else {
			$(this).addClass('done');
			var id = $(this).data("id"),
			action = $(this).data('action'),
			rateHolder = $(this).children('.count');
			var ajax_data = {
				action: "bigfa_like",
				um_id: id,
				um_action: action
			};
			$.post("/wp-admin/admin-ajax.php", ajax_data,
			function(data) {
				$(rateHolder).html(data);
			});
			return false;
		}
	};
	$(document).on("click", ".favorite",function() {
		$(this).postLike();
	});
	
	var settings = {
        progressbarWidth: '100%',
        progressbarHeight: '4px',
        progressbarColor: '#f2626f',
        progressbarBGColor: '#ffffff',
        defaultVolume: 0.8
    };
    $(".playerd").player(settings);
	
	fssilde();

})
// 滚屏
$(document).ready(function($) {
    // 利用 data-scroll 属性，滚动到任意 dom 元素
    $.scrollto = function(scrolldom, scrolltime) {	
        $(scrolldom).click( function(){ 
            var scrolltodom = $(this).attr("data-scroll");
            $(this).addClass("active").siblings().removeClass("active");
            $('html, body').animate({
                scrollTop: $(scrolltodom).offset().top
            }, scrolltime);
            return false;
        });		
    };
    // 判断位置控制 返回顶部的显隐
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500) {
            $("#back-to-top").fadeIn(600);
        } else {
            $("#back-to-top").fadeOut(600);
        }
    });
    // 启用
    $.scrollto("#back-to-top", 600);
});

function fssilde(){
	var mheader = document.getElementById( 'm-header' ),
		menuLeft = document.getElementById( 'm-nav' ),
		mcontainer = document.getElementById( 'm-container' ),
		mfooter = document.getElementById( 'm-footer' ),
		showLeftPush = document.getElementById( 'showLeftPush' );
	showLeftPush.onclick = function() {
		classie.toggle( mheader, 'm-header-open' );
		classie.toggle( menuLeft, 'm-nav-open' );
		classie.toggle( mcontainer, 'm-container-open' );
		classie.toggle( mfooter, 'm-footer-open' );
		disableOther( 'showLeftPush' );
	};
	function disableOther( button ) {
		if( button !== 'showLeftPush' ) {
			classie.toggle( showLeftPush, 'disabled' );
		}
			if( $('.m-container-open').length ){
		$(".mainContent").click(function() {
			$( '#m-header' ).removeClass('m-header-open');
			$( '#m-nav' ).removeClass('m-nav-open');
			$( '#m-container' ).removeClass('m-container-open');
			$( '#m-footer' ).removeClass('m-footer-open');
		});
	}
	}

var eventClick = 'click';
var closeEnable = false;
	$('#search-trigger').bind(eventClick, function(event) {
		$('#search-form').addClass('active');
		closeEnable = false;
		setTimeout(function() {
			closeEnable = true;
		}, 500);
	});

	$('#search-input-s').bind('blur', function(event) {
		if ( closeEnable ) {
			$('#search-form').removeClass('active');
		}
	});

	$('#search-form-close').bind(eventClick, function(event) {
		event.preventDefault();
		if (closeEnable) {
			$('#search-form').removeClass('active');
			$('#search-input-s').blur();
			closeEnable = false;
		}
	});
}