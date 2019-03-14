<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Menu superior -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 5px solid black">
    <a class="navbar-brand" href="#">IESDE - Teste</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Cadastro <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/listagem">Listagem</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/datatable">Datatable</a>
            </li>
        </ul>
        <div class="dropdown pull-right">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $this->session->nome . ' ' . $this->session->sobrenome;?> 
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/cadastro/deslogar">Deslogar</a>
            </div>
        </div>
    </div>
</nav>
<!-- Abre um formulario post para o controle cadastro metodo principal index -->
<?php
    //$this->upload->display_errors('<p>', '</p>');
    $this->load->helper('url');
    echo form_open_multipart('cadastro/index', array('method'=>'post'));
?>
 
<div style="margin: 20px">
    <!-- Nome -->
    <div class="form-group" style="margin-bottom: 3px">
        <label for="nomeCompleto">Nome Completo:</label>
        <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" value="<?php if($pessoa == null) {echo set_value('nomeCompleto');}else{echo $pessoa[0]->Nome . ' ' . $pessoa[0]->Sobrenome;}; ?>" placeholder="Nome Completo">
        <?php echo form_error('nomeCompleto', '<div class="alert alert-danger">', '</div>'); ?>
    </div>
    <!-- Email -->
    <div class="form-group" style="margin-bottom: 3px">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php if($pessoa == null) {echo set_value('email');}else{echo $pessoa[0]->Email;}; ?>" placeholder="Digite o email">
        <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
    </div>
    <!-- Senha -->
    <div class="form-group" style="margin-bottom: 3px">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" value="<?php if($pessoa == null) {echo set_value('senha');}else{echo $pessoa[0]->Senha;}; ?>" placeholder="Digite a senha">
        <?php echo form_error('senha', '<div class="alert alert-danger">', '</div>'); ?>
    </div>
    <!-- Confirmação -->
    <div class="form-group" style="margin-bottom: 3px">
        <label for="confirmaSenha">Confirmar senha</label>
        <input type="password" class="form-control" id="confirmaSenha" name="confirmaSenha" value="<?php if($pessoa == null) {echo set_value('confirmaSenha');}else{echo $pessoa[0]->Senha;}; ?>" placeholder="Repita a senha">
        <?php echo form_error('confirmaSenha', '<div class="alert alert-danger">', '</div>'); ?>
    </div>
    <!-- Estado -->
    <div class="form-group" style="margin-bottom: 3px">
        <label for="estado">Selecione Estado</label>
        <select class="form-control" id="estado" value="<?php if($pessoa == null) {echo set_value('estado');}else{echo $pessoa[0]->EstadoID;}; ?>" name="estado">
            <option value="<?php if($pessoa == null) {echo set_value('estado');}else{echo $pessoa[0]->EstadoID;}; ?>">
                <?php if($pessoa == null) {echo 'Selecione...';}else{echo $pessoa[0]->Sigla;}; ?>
            </option>
            <?php
                foreach($estados as $estado){
                    ?> 
                        <option value="<?php echo $estado->EstadoID ?>"><?php echo $estado->Sigla ?></option>
                    <?php
                }
            ?>
        </select>
        <?php echo form_error('estado', '<div class="alert alert-danger">', '</div>'); ?>
    </div>
    <!-- Cidade -->
    <div class="form-group" style="margin-bottom: 3px">
        <label for="cidade">Cidade:</label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="<?php if($pessoa == null) {echo set_value('cidade');}else{echo $pessoa[0]->Cidade;}; ?>" placeholder="Digite a cidade">
        <?php echo form_error('cidade', '<div class="alert alert-danger">', '</div>'); ?>
    </div>
    <!-- Arquivo -->
    <div class="form-group" style="margin-bottom: 3px">
        <label for="foto">Foto:</label>
        <input type="file" class="form-control" id="foto" name="foto" value="<?php if($pessoa == null) {echo set_value('foto');}else{echo $pessoa[0]->Foto;}; ?>"/>
        <?php echo form_error('foto', '<div class="alert alert-danger">', '</div>'); ?>
    </div>
    <!-- Tipo Operação e ID Ocultos -->
    <input type="hidden" name="tipoOperacao" value="<?php if($pessoa == null) {echo 'insert';}else{echo 'update';}; ?>" />
    <input type="hidden" name="idPessoa" value="<?php if($pessoa != null) {echo $pessoa[0]->PessoaID;}; ?>" />

    <button type="submit" class="btn btn-primary"><?php if($pessoa == null) {echo 'Cadastrar';}else{echo 'Alterar Dados';}; ?></button>
</div>

<?php
    echo form_close();
?>
