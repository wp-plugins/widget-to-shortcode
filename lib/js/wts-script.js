jQuery(document).ready(function($){
	//select shortcode
	$('.wts-shortcodes').on('click',function(){

		if($(this).attr('data-is-selected') == 0){
			$(this).attr('data-is-selected',1)
			.addClass('wts-shortcode-selected');
			
		}else{
			$(this).attr('data-is-selected',0)
			.removeClass('wts-shortcode-selected');
		}
	});
	
	$('#wts-insert').click(function(){
		$('.wts-shortcodes').each(function(){
			if($(this).attr('data-is-selected') == 1){
				wp.media.editor.insert('[wts widget="' +$(this).data('class')+ '" id="' +$(this).data('option')+ '" number="' +$(this).data('number')+ '"]' );	
			}
		});	
		$('.wts-shortcodes').attr('data-is-selected',0).removeClass('wts-shortcode-selected');;
	});
});