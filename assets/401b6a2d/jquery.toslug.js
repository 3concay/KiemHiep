(function($){
	$.fn.toSlug = function(options){
		var def = {"target":"#"};
		var opt = $.extend(def,options);
		return this.each(function(){
			$(this).bind("keyup change",function(){
				$(opt.target).val($(this).val().toAlias());
			})
		});
	};
})(jQuery);