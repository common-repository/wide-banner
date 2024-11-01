jQuery(document).ready(function ($) {
    
    ///:
    $(document).on('click', '#save', function (e) {
        //
        e.preventDefault();
        var form = $('#save-wb');
        $('#save-wb input').removeClass('error-form');
        //
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: form.serialize() + '&action=save_wb'
        }).done(function (response) {
            console.log(response);
            if ((response == 'wb_banner') || (response == 'btn_link') || (response == 'wb_btn_text')) {
                var seq = "#" + response;
                $(seq).addClass('error-form');
                $('#form-message').html('<span class="error">Please correct empty fields</span>');
            } else if (response == 'error_url') {
                $('#btn_link').addClass('error-form');
                $('#form-message').html('<span class="error">Please correct url field (ex: https://www.mylink.com)</span>');
            } else if (response == 'error_all') {
                $('#form-message').html('<span class="error">Error. Some fields are empty.</span>');
            } else {
                $('.hide').hide();
                $('.hideFull').hide();
                $('#form-message').html('<div id="form-valid">Your Banner is created.<br/>You can find it  in the "list of Banners" tab.');
                $('#save-wb').trigger("reset");
            }

        });
    });
    /////  
    $(".changeit").change(function () {
        var val = $(this).val();
        var seq = $(this).attr('id');
        seq = "#" + seq + "_hexa";
        $(seq).val(val);
    });
    ////    
    $('#add_btn').change(function () {
        var val = $(this).val();
        if(val=='btn') {
            $('.hide').show();
            $('.hideFull').show();
        }else if(val=='full') {
            $('.hide').hide();
            $('.hideFull').show();
        }else{
             $('.hide').hide();
            $('.hideFull').hide();
            
        }
        
        

    });
    ////
     $(".activate").click(function (e) {
       //  e.preventDefault(e);
        var whichone = parseInt($(this).data('id'));
        var identifiant = '#wb-'+whichone+' span';
        $(identifiant).html('Save...');
       if( $(this).is(':checked') ){
          
           $.ajax({
            url: ajaxurl,
            type: "POST",
            data: 'idban='+whichone+'&action=activate_wb'
            }).done(function (response) {
                 $(identifiant).html('');
           })
       }else{
            $.ajax({
            url: ajaxurl,
            type: "POST",
            data: 'idban='+whichone+'&action=desactivate_wb'
            }).done(function (response) {
                 $(identifiant).html('');
            })
       }
       
        
    });
////
     $(document).on('click', '.delete', function (e) {
        var whichone = $(this).data('id');
        $(this).html('<span class="deleteme" data-id="'+whichone+'">Confirm?</span>');
         
    });
/////
    $(document).on('click', '.deleteme', function (e) {
        var whichone = $(this).data('id');
        $(this).html('In progress...');
        //
         $.ajax({
            url: ajaxurl,
            type: "POST",
            data: 'idban='+whichone+'&action=delete_wb'
            }).done(function (response) {
                $('#line-'+whichone).toggle("slide");
            })
    });
});

