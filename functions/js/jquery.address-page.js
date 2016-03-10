$(document).ready(function(){
    var page = 'include/functions/process_address.php';

    function ajaxindicatorstart(){
        var gif= $('div.box.box-standard').html('<img alt="" src="../img/Loading_icon.gif" style="opacity: 0.3;"/>');
        gif.fadeIn(300);
    }

    $( document ).ajaxStart(function() {
        ajaxindicatorstart();
    });

    $(function() {
        var form =$('form.address-form.add-form.edit-form');
        var small = form.find('div.formfield.short.left').get();
        $.each(small, function(){
            $(this).addClass('small-panel').css({"padding-left" : "10px", "margin-right" : "0"});
        });
        form.find('div.med.left').addClass('small-panel').css({"padding-left" : "10px", "margin-right" : "0"});
        form.find('label[for="add_phone"]').parent().addClass('clearL');
    });



    $("button.edit.button").click(function(e) {
        e.preventDefault();
        var id=$(this).parent('div.buttons.edit_button').attr('id');
            $.ajax({
                type: 'POST',
                url : page,
                data: {edit_id : id},
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
            $.ajax({
                type: 'POST',
                url : page,
                data: {edit_id : id},
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
