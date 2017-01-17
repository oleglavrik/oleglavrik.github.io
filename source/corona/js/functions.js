
	 $(document).ready(function() {
		 Cufon.replace(".sevises_list li div", { fontFamily: 'Pragmatica' });
		 Cufon.replace(".sidebarp2title", { fontFamily: 'PragmaticaLightC' });
		 Cufon.replace(".cbp2_title", { fontFamily: 'PragmaticaLightC' });
		 Cufon.replace(".sidebar_page_list span", { fontFamily: 'PragmaticaLightC' });
		
		 
		 // datepick
		 $('#defaultPopup,#defaultInline').datepick({dateFormat: 'DD, MM, yyyy',  altField: '#date', altFormat: 'dd/mm/yyyy', defaultDate: 'dd/mm/yyyy', selectDefaultDate: true}); 
		 $('#defaultPopup1,#defaultInline').datepick({dateFormat: 'DD, MM, yyyy',  altField: '#date1', altFormat: 'dd/mm/yyyy', defaultDate: 'dd/mm/yyyy', selectDefaultDate: true});   
		 $('#defaultPopup2,#defaultInline').datepick({dateFormat: 'DD, MM, yyyy',  altField: '#date2', altFormat: 'dd/mm/yyyy', defaultDate: 'dd/mm/yyyy', selectDefaultDate: true});
		 $('#defaultPopup3,#defaultInline').datepick({dateFormat: 'DD, MM, yyyy',  altField: '#date3', altFormat: 'dd/mm/yyyy', defaultDate: 'dd/mm/yyyy', selectDefaultDate: true});
		 
		 $('.disablePicker').toggle(function() { 
		         $(this).text('Enable').siblings('.hasDatepick'). 
		             datepick('disable'); 
		         
		     }, 
		     function() { 
		         $(this).text('Disable').siblings('.hasDatepick'). 
		             datepick('enable'); 
		     } 
		  
		 ); 
		  
		 $('#removePicker').toggle(function() { 
		         $(this).text('Re-attach'); 
		         $('#defaultPopup,#defaultInline').datepick('destroy'); 
		     }, 
		     function() { 
		         $(this).text('Remove'); 
		         $('#defaultPopup,#defaultInline').datepick(); 
		     });
		// endpick
		 
		// slider 
		$(function () {
			$('#slider').anythingSlider({
				startStopped    : false, // If autoPlay is on, this can force it to start stopped
				toggleControls  : false,
				delay :2000
			});
	});
		//endslider
		
		// lenguage tabs
		(function($) {
			$(function() {

				$('ul.tabs').delegate('li:not(.current_len)', 'click', function() {
					$(this).addClass('current_len').siblings().removeClass('current_len')
						
				})

			})

			})(jQuery)
			// end lenguage tubs
			
			 
	 })
