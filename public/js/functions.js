$(document).ready(function() {
    $(document).on('submit', '.generic_form', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                //$('input,textarea,select').attr('disabled','disabled');
            },
            error: function(response) {
            },
            success: function(response) {
                
                if(response.valid)
                {
                    if (response.redirect) {
                        window.location = response.redirect;
                    }

                    $('#myModal .modal-body').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    $('#myModal').modal('show');
                }
                else
                {

                    $('#myModal .modal-body').html('<div class="alert alert-warning" role="alert">' + response.message + '</div>');
                    $('#myModal').modal('show');
                    $(response.target).focus();
                }
            }
        });
        
    });
    
    // Consutar la descripción de la refaccion en el modulo de solicitar una liga.
    $('.form_ligas #ipt_componente').blur(function(){
        var np = $(this).val();

        $.ajax({
            type: 'post',
            url: 'process/' + np,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                //$('input,textarea,select').attr('disabled','disabled');
            },
            error: function(response) {
            },
            success: function(response) {
                
                if(response.valid)
                {
                    $('.get_txt_desc').html('<p><strong>Descripción:</strong> ' + response.np_description + '</p>');
                }
                else
                {
                    $('#ipt_componente').val('');
                    $('#myModal .modal-body').html('<div class="alert alert-warning" role="alert">' + response.message + '</div>');
                    $('#myModal').modal('show');
                    $(response.target).focus();
                }
            }
        });
    });
    
    // Generic form with ajax data processing
    /*$(document).on('submit', '.generic_form', function(e) {
        e.preventDefault();
        
        if (!FormBusy) {
            FormBusy = true;
            showProgressBar();
            
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('input,textarea,button').attr('disabled','disabled');
                },
                error: function(response) {
                    bootbox.dialog({
                        message:'<div class="alert alert-danger alert-dismissible fade in" role="alert">' +
                                response.responseText +
                            '</div>',
                        buttons : {
                            "Cerrar": {
                                className: "btn-special focus-me",
                                callback: function() {
                                    FormBusy = false;
                                    $('input,textarea,button').removeAttr('disabled');
                                    
                                }
                            }
                        },
                        closeButton: false
                    });
                    setTimeout(function() {
                        $('.focus-me').focus();
                    }, 500);
                    
                    hideProgressBar();
                },
                success: function(response) {
                    
                    if (response.valid) {
                        
                        if (response.redirect) {
                            window.location = response.redirect;
                        }
                        else if (response.reload) {
                            location.reload();
                        }
                        else {
                            if (response.response != '') {
                                bootbox.dialog({
                                    message: '<div class="alert alert-success alert-dismissible fade in" role="alert">' +
                                            response.response +
                                        '</div>',
                                    buttons : {
                                        "Aceptar": {
                                            className: "btn-special focus-me",
                                            callback: function() {
                                                FormBusy = false;
                                                $('input[type=text],input[type=email],input[type=tel],textarea').val('');
                                                $('input,textarea,button').removeAttr('disabled');
                                            }
                                        }
                                    },
                                    closeButton: false
                                });
                                setTimeout(function() {
                                    $('.focus-me').focus();
                                }, 500);
                            }
                            else {
                                $('input[type=text],textarea').val('');
                                $('input,textarea,button').removeAttr('disabled');
                            }
                            hideProgressBar();
                        }
                    }
                    else {
                        bootbox.dialog({
                            message: '<div class="alert alert-warning alert-dismissible fade in" role="alert">' +
                                    response.response +
                                '</div>',
                            buttons : {
                                "Cerrar": {
                                    className: "btn-special focus-me",
                                    callback: function() {
                                        FormBusy = false;
                                        $('input,textarea,button').removeAttr('disabled');
                                        
                                        setTimeout(function() {
                                            $(response.target).focus();
                                        }, 500);
                                    }
                                }
                            },
                            closeButton: false
                        });
                        setTimeout(function() {
                            $('.focus-me').focus();
                        }, 500);
                        
                        hideProgressBar();
                    }
                }
            });
        }
    });
    */
    //$('input,textarea,button,select').removeAttr('disabled');
    //$('.form-control').val('');
   
    $(document).on('submit', '.generic_form_files', function(e) {
        e.preventDefault();

        alert("ola");

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                //$('input,textarea,select').attr('disabled','disabled');
            },
            error: function(response) {
            },
            success: function(response) {
                
                if(response.valid)
                {
                    if (response.redirect) {
                        window.location = response.redirect;
                    }

                    $('#myModal .modal-body').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    $('#myModalFile').modal('show');
                }
                else
                {

                    $('#myModal .modal-body').html('<div class="alert alert-warning" role="alert">' + response.message + '</div>');
                    $('#myModal').modal('show');
                    $(response.target).focus();
                }
            }
        });
        
    });
});