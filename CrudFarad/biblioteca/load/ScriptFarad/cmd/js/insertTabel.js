function cadastrar(idform, tabela, banco, estilo, colunaVerific) {



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
                if (value.length < 1) {

                    alert('Opa preencha o campo ' + name);
                    breack;
                }

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
            if (value.length < 1 && this.required) {


                $('#' + idform + 2).html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Opa!!!</h4>Preencher campo ' + name + '  </div>');



                var variavel = setTimeout(function() {



                        $('#' + idform + 2).html('');



                    },
                    1000);


                false;
            }


        }

        percorre++;
    });



    var parametros = {
        coluna: envioColuna,
        valor: envioValor,
        tabel: tabela,
        tipoImput: envioType,
        banco: banco,
        estilo: estilo,
        colunaVerific: colunaVerific,
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






            if (estilo == 'login') {

                if (msg.trim() == 'logado') {

                    alertsucess = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Logado !!!</h4>' + tabela + '  Você fez o login sucesso.</div>';

                } else {



                    alertsucess = '<div class="alert alert-danger" role="alert">Erro de login ou senha!!!<h3> Por favor tente novamente!!! não foi possivel fazer o login.</h3> </div>';
                }
            } else {

                if (msg.trim() == 'sucesso') {

                    var alertsucess = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> ' + tabela + ' Cadastrado!!!</h4>' + tabela + '  Cadastrado com sucesso.</div>';

                } else {

                    alertsucess = '<div class="alert alert-danger" role="alert">Opa já existe esse registro!!<h3> Já existe esse registro, tente outro diferente.</h3> </div>';



                }


            }






            $("#mostra").html(alertsucess);
            var vazio = '';

            var variavel = setTimeout(function() {
                var string = 'login';





                if (estilo == 'login') {
                    if (msg.trim() == 'logado') {

                        window.location = 'index.php';



                    } else {

                        document.getElementById('mostra').innerHTML = '';
                    }



                } else {


                    if (msg.trim() == 'sucesso') {





                    } else {



                    }


                    document.getElementById('mostra').innerHTML = msg;

                    $('#' + idform)[0].reset();
                }


                $("#mostra").html('');


            }, 2000);

        })
        .fail(function(jqXHR, textStatus, msg) {
            //  $("#acao").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Erro!</h4>' + msg + '</div>');
        });


}