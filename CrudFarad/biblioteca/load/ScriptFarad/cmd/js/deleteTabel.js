function cadastrar(idform, tabela) {



    var $inputs = $('#' + idform + ' :input');






    var envioValor = [];
    var envioColuna = [];
    var envioType = [];
    var values = {};
    // percorre os inputs 
    var percorre = 0;
    $inputs.each(function() {

        if (this.type == 'radio' || this.type == 'checkbox') {


            if (this.checked) {

                var name = this.name; // nome do input
                var value = $(this).val(); // valor do input
                envioType[percorre] = this.type
                envioColuna[percorre] = name;
                envioValor[percorre] = value;

            }





        } else {

            var name = this.name; // nome do input
            var value = $(this).val(); // valor do input
            envioType[percorre] = this.type
            envioColuna[percorre] = name;
            envioValor[percorre] = value;

        }

        percorre++;
    });



    var parametros = {
        coluna: envioColuna,
        valor: envioValor,
        tabel: tabela,
        tipoImput: envioType,

    };



    $.ajax({

            url: "inserir.php",
            type: 'post',
            data: parametros,


            beforeSend: function() {
                $("#mostra").html("<img src='https://media.tenor.com/images/d7395086d84d174728d8001d8bd0f563/tenor.gif'>");
            }
        })
        .done(function(msg) {
            var alertsucess = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Cadastrado!!!</h4>Ficha  Cadastrado com sucesso.</div>';




            alert('deucerto');

            $("#mostra").html(alertsucess);
            var vazio = '';

            var variavel = setTimeout(function() {

                document.getElementById('mostra').innerHTML = msg;
                //window.location = 'inserir.php';
                $('#' + idform)[0].reset();


            }, 500);



        })
        .fail(function(jqXHR, textStatus, msg) {
            //  $("#acao").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Erro!</h4>' + msg + '</div>');
        });

}