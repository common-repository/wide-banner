jQuery(document).ready(function ($) {    
     $.ajax({
            url: ajaxurl,
            type: "POST",
            data: 'idban=test&action=show_wb'
            }).done(function (response) {
                 $(response).prependTo('body');
            })
});