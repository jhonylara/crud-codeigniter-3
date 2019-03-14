<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Menu superior -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">IESDE - Teste</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/cadastro">Cadastro </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Listagem <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/datatable">Datatable <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 pull-right" action="listagem" method="post">
            <input class="form-control mr-sm-2" type="search" name="textoPesquisa" placeholder="Pesquisar por nome" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
        <div style="width: 10px"></div>
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

<style>
    .table td, .table th {
        padding: .75rem;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }
</style>
<div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
                <th scope="col">Foto</th>
                <th scope="col">Email</th>
                <th scope="col">Senha</th>
                <th scope="col">Estado</th>
                <th scope="col">Cidade</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php

                if($results == true){                    
                    $this->benchmark->mark('code_start');
                    foreach($results as $pessoa){
                        ?> 
                            <tr>
                                <td scope="row"><?php echo $pessoa->PessoaID ?></td>
                                <td><?php echo $pessoa->Nome ?></th>
                                <td><?php echo $pessoa->Sobrenome ?></th>
                                <td>
                                    <?php 
                                        if($pessoa->Foto != null){
                                            ?>
                                                 <img class="img-responsive" style="height: 35%; display: block; margin-left: auto; margin-right
                                                : auto;  vertical-align: middle;" src="<?php echo $pessoa->Foto ?>"/>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $pessoa->Email ?></th>
                                <td><?php echo $pessoa->Senha ?></th>
                                <td><?php echo $pessoa->Descricao ?></th>
                                <td><?php echo $pessoa->Cidade ?></th>
                                <td style="width: 50px;"><a class="btn btn-primary" href="/cadastro/<?php echo $pessoa->PessoaID ?>" role="button" style="display: flex;
                justify-content: center;">Editar</a></th>
                                <td style="width: 50px;"><a class="btn btn-danger" href="/cadastro/excluir/<?php echo $pessoa->PessoaID ?>" role="button">Excluir</a></th>
                            </tr>
                        <?php
                    }                        
                }else{
                    ?>
                        <p>Não encontrou nada com essa pesquisa</p>
                    <?php
                }

                $this->benchmark->mark('code_end');

                echo $this->benchmark->elapsed_time('code_start', 'code_end');
            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<div class="row">
    <div class="col-10">
    </div>
    <div class="col-2">
            <?php echo $links; ?>
    </div>
</div>