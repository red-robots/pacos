jQuery(document).ready(function ($) {

	$(document).on("submit","form.search-item",function(e){
		e.preventDefault();
		var search = $("input#search_input").val();
		var pagenum = $("input#pagenum").val();
		do_search_keywords(search,pagenum);
	});

	$(document).on("click","#moreResultButton",function(e){
		e.preventDefault();
		var pagenum = $(this).attr("data-nextpage");
		var search = $("input#search_input").val();
		do_search_keywords(search,pagenum);
	});

	$(document).on("click",".result-item",function(e){
		e.preventDefault();
		var page_url = $(this).attr('data-url');
		window.location.href = page_url;
	});

	function do_search_keywords(string,pagenum=1) {
		var str = $.trim(string);
		var newStr = str.replace(/(^\s+|\s+$)/g,'');
		var limit_num = $("input#limitnum").val();
		if(newStr) {
			$.ajax({
	            type : "post",
	            dataType : "json",
	            async : false,
	            url : ajax_url.ajaxurl,
	            data : {
	                action: "load_result", 
	                search : newStr,
	                page: pagenum,
	                limit: limit_num
	            },
	            beforeSend:function(obj){
	               $("#spinner").show();
	               $(".search-icon").hide();
	            },
	            success: function(obj) {
					setTimeout(function(){
						$("#spinner").hide();
						$(".search-icon").show();
					},1000);

					var content = obj.content;
					var next = obj.next_page;
					var end = obj.is_end;
					if(content) {
						$("input#pagenum").val(next);
						var encoded_str = encodeURIComponent(str);
						var new_url = currentURL + '?q=' + encoded_str;
						window.history.replaceState( null, null, new_url );
						$("#search_results").append(content);
						$(".view-more-button").not(':last').remove();
						if(end) {
							$(".view-more-button").remove();
						}
						setTimeout(function(){
							$("#spinner").hide();
							$(".search-icon").show();
							$("#search_results .result-item").removeClass('hide');
						},600);
					}
	            }
	        });
	    }
	}

});