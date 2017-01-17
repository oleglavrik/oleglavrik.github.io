/**
 * @author ����
 */
   Cufon.replace(".comapny_slodan", { fontFamily: 'MetaBoldC' });
	 Cufon.replace(".svet_line", { fontFamily: 'FranklinGothicBookC' });
	 Cufon.replace(".tel, .dec_link", { fontFamily: 'Myriad Pro' });
	 Cufon.replace(".info_text", { fontFamily: 'Myriad Pro italic' });
	 
	 
	 
	 
	 $(document).ready(function() {
	 	$('.main_menu li a:last').css('border','none');
		$('.drop_menu li a:last').css('border','none');
		$('.drop_menu_2 li a:last').css('border','none');
		$('.drop_menu_3 li a:last').css('border','none');
		$('.right_menu li:last').css('border-bottom','none');
		
		$('#search_btn').click(function() {
			$('.search_block').slideToggle();
		});
		
		$('.main_menu > li').mouseover(function() {
			$(this).find('ul:first').show().parent('div').show();
		});
		$('.main_menu > li').mouseleave(function() {
			$(this).find('ul:first').hide().parent('div').hide();
		});
		
		$('.drop_menu li').mouseover(function() {
			$(this).find('ul:first').show().parent('div').show().parent('div').show();
		});
		$('.drop_menu li').mouseleave(function() {
			$(this).find('ul:first').hide().parent('div').hide().parent('div').show();
		});
		
		
		$(function () {
			$('#slider').anythingSlider({
				startStopped    : false, // If autoPlay is on, this can force it to start stopped
				toggleControls  : false,
				delay :5000
			});
	});
	 })
