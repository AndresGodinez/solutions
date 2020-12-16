let jsEscape = function (str){
  return String(str).replace(/[^\w. ]/gi, function(c){
     return '\\u'+('0000'+c.charCodeAt(0).toString(16)).slice(-4);
  });

}

let validURL = function (url){
    let hrefURL, pageURL;

    if(url.startsWith("/")){
        return url;
    }
    try{
        hrefURL = new URL(url);
        pageURL = new URL(window.location);

        if (hrefURL.host === pageURL.host) {
            return url;
    }
    }catch(e){
        return '';
    }
    return '';
}



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

                        window.location = validURL(response.redirect);

                    }

                    $('#myModal .modal-body').html('<div class="alert alert-success" role="alert">' + jsEscape(response.message) + '</div>');
                    $('#myModal').modal('show');
                }
                else
                {

                    $('#myModal .modal-body').html('<div class="alert alert-warning" role="alert">' + jsEscape(response.message) + '</div>');
                    $('#myModal').modal('show');
                    $(jsEscape(response.target)).focus();
                }
            }
        });

    });

    // Consutar la descripción de la refaccion en el modulo de solicitar una liga.
    $('.form_ligas #ipt_componente').blur(function(){
        let np = $(this).val();

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
                    $('.get_txt_desc').html('<p><strong>Descripción:</strong> ' + jsEscape(response.np_description) + '</p>');
                }
                else
                {
                    $('#ipt_componente').val('');
                    $('#myModal .modal-body').html('<div class="alert alert-warning" role="alert">' + jsEscape(response.message) + '</div>');
                    $('#myModal').modal('show');
                    $(jsEscape(response.target)).focus();
                }
            }
        });
    });

    $(document).on('submit', '.generic_form_files', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
            },
            error: function(response) {
            },
            success: function(response) {

                if(response.valid)
                {
                    if (response.redirect) {

                        window.location = validURL(response.redirect);

                    }

                    $('#myModal .modal-body').html('<div class="alert alert-success" role="alert">' + jsEscape(response.message) + '</div>');
                    $('#myModalFile').modal('show');
                }
                else
                {

                    $('#myModal .modal-body').html('<div class="alert alert-warning" role="alert">' + jsEscape(response.message) + '</div>');
                    $('#myModal').modal('show');
                    $(jsEscape(response.target)).focus();
                }
            }
        });

    });
});
