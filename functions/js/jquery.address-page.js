$(document).ready(function(){
    function ajaxindicatorstart(){
        var gif= $('div.box.box-standard').html('<img alt="" src="../img/common/Loading_icon.gif" />');
        gif.fadeIn(300);
    }

    $( document ).ajaxStart(function() {
        ajaxindicatorstart();
    });

    $("button.edit.button").click(function(e) {
        e.preventDefault();
        var id=$(this).parent('div.buttons.edit_button').attr('id');
        var page= 'include/functions/process_address.php';
            $.ajax({
                type: 'GET',
                url : page,
                data: {edit : id},
                dataType: 'html',
                beforeSend: function() {
                    ajaxindicatorstart();
                },
                success: function(response){
                    $('div.box.box-standard').html(response).fadeIn('slow');
                }
            });
    });

    $("a.form-link.add_address").click(function(e) {
        e.preventDefault();
        var id='new';
        var page= 'include/functions/process_address.php';
            $.ajax({
                type: 'GET',
                url : page,
                data: {edit : id},
                dataType: 'html',
                beforeSend: function() {
                    ajaxindicatorstart();
                },
                success: function(response){
                    $('div.box.box-standard').html(response).fadeIn('slow');
                }
            });
    });

    $("button.save.address").click(function (e) {
        e.preventDefault();
        var form =$('form.address-form.add-form.edit-form');
        var page = 'include/functions/process_address.php';
        var id=$(this).closest(form).parent().attr('class');
            $.ajax({
                type: 'POST',
                url: page,
                data: {action: 'save address', edit_id : id, address :form.serialize()},
                dataType: 'html',
                beforeSend: function() {
                    ajaxindicatorstart();
                },
                success: function (response) {
                    var error = $(response).filter('#error').text();
                    if(error){
                        $('div.box.box-standard').html(response);
                    }
                    else{
                        location.assign("account-addresses.php");
                    }
                }
            });
    });

});
