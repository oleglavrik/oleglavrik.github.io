function checkSubmit(e)
{
   if(e && e.keyCode == 13)
   {
      document.forms[0].submit();
   }
}
  
// BEGIN STYLIN CHECKBOX [remember me]
(function($) {  
    $(function() {  
        $('#signRememberMe').styler();
    })  
})(jQuery)
// END STYLIN CHECKBOX [remember me]
// End fakePasstord
$(document).ready(function() {
    // POPUP DIFFERENT LANGUAGES
    $('a.select_language').click(function(e) {
        var $message = $('div.popupLanguageBox');

        if ($message.css('display') != 'block') {
            $message.show();

            var firstClick = true;
            $(document).bind('click.Event0', function(e) {
                if (!firstClick && $(e.target).closest('div.popupLanguageBox').length == 0) {
                    $message.hide();
                    $(document).unbind('click.Event0');
                }
                firstClick = false;
            });
        }

        e.preventDefault();
    });
    // END POPUP DIFFERENT LANGUAGES

    // POPUP ENTER USER
    $('a.enter_user_link').click(function(e) {
        var $message = $('div.popup_entry_user');

        if ($message.css('display') != 'block') {
            $message.show();

            var firstClick = true;
            $(document).bind('click.Event1', function(e) {
                if (!firstClick && $(e.target).closest('div.popup_entry_user').length == 0) {
                    $message.hide();
                    $(document).unbind('click.Event1');
                }
                firstClick = false;
            });
        }


        e.preventDefault();
    });
    // END POPUP ENTER USER    
    
    // POPUP ABOUT COMPANY
    $('.indexFaq').click(function(e) {
        var $message = $('div.popup_about_company');

        if ($message.css('display') != 'block') {
            $message.show();

            var firstClick = true;
            $(document).bind('click.Event2', function(e) {
                if (!firstClick && $(e.target).closest('div.popup_about_company').length == 0) {
                    $message.hide();
                    $(document).unbind('click.Event2');
                }
                firstClick = false;
            });
        }


        e.preventDefault();
    });
    // END POPUP ABOUT COMPANY    
    //event return kay press in sign form
    $('#signForm').submit(
                                function(){
                                            //event.preventDefault();
                                            accountSignIn(); 
                                            return false; 
                                        }
                                    );
    //event return kay press in reg form
    $('#regForm').submit(
                                function(){
                                            //event.preventDefault();
                                            accountRegister(); 
                                            return false; 
                                        }
                                    );
                                        
});