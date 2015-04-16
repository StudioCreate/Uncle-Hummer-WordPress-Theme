
jQuery(document).ready(function(){
   jQuery(".rms_import").click(function(){
       jQuery('.rms_import').click(function(){
            var import_true = confirm('are you sure to import dummy content ? it will overwrite the existing data');
            if(import_true == false) return;

            jQuery('.import_message').html('<p class="myicon"><i class="icon-spin4 animate-spin"></i></p> Data is being imported please be patient, while the awesomeness is being created.  ');
        var data = {
            'action': 'my_action'       
        };

       // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function(response) {
            jQuery('.import_message').html('<div class="import_message_success">'+ response +'</div>');
            //alert('Got this from the server: ' + response); <i class="fa fa-spinner fa-3x fa-spin"></i>
        });
    });
   }) ;
});