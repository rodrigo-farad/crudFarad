nome = $("#nome").val();
if (nome == '') {
    alert('Preencha pelo menos o nome!!!');


} else {

    var parametros = {


        email: $("#email").val(),



    };


    $.ajax({
            url: "inserir.php",
            type: 'post',
            data: parametros,

            beforeSend: function() {
                // $("#acao").html("<img src='https://media.tenor.com/images/d7395086d84d174728d8001d8bd0f563/tenor.gif'>");
            }
        })
        .done(function(msg) {
            var alertsucess = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Cadastrado!!!</h4>Ficha  Cadastrado com sucesso.</div>';


            $("#acao").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Erro!</h4>Já existe esse cadastro com esse nome</div>');



            $("#acao").html(alertsucess);
            var vazio = '';

            var variavel = setTimeout(function() {
                window.location = 'perfil_cliente.php?id_cliente=' + msg;



            }, 2000);



        })
        .fail(function(jqXHR, textStatus, msg) {
            $("#acao").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Erro!</h4>' + msg + '</div>');
        });
}