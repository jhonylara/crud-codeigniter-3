<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


<!DOCTYPE html>
<html>
    <head>
        <title>IESDE</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            body {background: #FFF; font-family: Verdana; font-size: 9pt; }
            #form_login { width: 500px; margin: 0 auto; padding: 20px; background: #F2F2F2; border: 1px solid #B7B7B7; }
            label { display: block; margin-bottom: 0.3em; }
            input[type=text], input[type=password] { border: 1px solid #666; display: block; margin-bottom: 1em; padding: 2px; width: 100%; }
            input[type=text], input[type=password] { display: block; }
            h1 { margin: 0 0 1em 0; text-align: center; }
            .error { background: none repeat scroll 0 0 #FBE6F2; border: 1px solid #D893A1; padding: 5px; }
        </style>
    </head>
    <body>
        <!-- Abre um formulario post para o controle cadastro metodo principal index -->
        <?php
            //$this->upload->display_errors('<p>', '</p>');
            $this->load->helper('url');
            echo form_open();
        ?>

            
            <div id="form_login" style="margin-top:20px">
                <h1>Acessar o IESDE</h1>
                <!-- Nome -->
                <div class="form-group">
                    <label for="nomeCompleto">Nome Completo:</label>
                    <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" value="<?php echo set_value('nomeCompleto'); ?>" placeholder="Nome Completo">
                    <?php echo form_error('nomeCompleto', '<div class="alert alert-danger">', '</div>'); ?>
                </div>

                <!-- Senha -->
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha"  placeholder="Digite a senha">
                    <?php echo form_error('senha', '<div class="alert alert-danger">', '</div>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </div>

        <?php
            echo form_close();
        ?>
    </body>
</html>