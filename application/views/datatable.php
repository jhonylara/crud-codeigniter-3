<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pessoas</title>
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#book-table').DataTable( {
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ itens por pagina",
                        "zeroRecords": "Nenhum item encontrado",
                        "info": "Pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Nenhum item adicionado",
                        "search":         "Pesquisar:",
                        "paginate": {
                            "next":       "Proxima",
                            "previous":   "Anterior"
                        },
                        "infoFiltered": "(Filtrado de _MAX_ total itens)"
                    }
                });
            });
        </script>
    </head>
    <body>
        <!-- Menu superior -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 5px solid black">
            <a class="navbar-brand" href="#">IESDE - Teste</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/cadastro">Cadastro </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/listagem">Listagem <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Datatable <span class="sr-only">(current)</span></a>
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
        <div style="margin: 30px">
            <table id="book-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
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
                        
                        $this->benchmark->mark('code_start');
//                        for($i=0; $i <= 1000; $i++){
                            foreach($pessoas as $pessoa){
                                ?> 
                                    <tr>
                                        <td scope="row"><?php echo $pessoa->PessoaID ?></td>
                                        <td><?php echo $pessoa->Nome ?></td>
                                        <td><?php echo $pessoa->Sobrenome ?></td>
                                        <td style="padding: 5px">
                                            <?php 
                                                if($pessoa->Foto != null){
                                                    ?>
                                                        <img class="img-responsive" style="height: 35%; display: block; margin-left: auto; margin-right
                                                        : auto;  vertical-align: middle;" src="<?php echo $pessoa->Foto ?>"/>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $pessoa->Email ?></td>
                                        <td><?php echo $pessoa->Senha ?></td>
                                        <td><?php echo $pessoa->Descricao ?></td>
                                        <td><?php echo $pessoa->Cidade ?></td>
                                        <td style="width: 50px;"><a class="btn btn-primary" href="/cadastro/<?php echo $pessoa->PessoaID ?>" role="button" style="display: flex;
                        justify-content: center;">Editar</a></td>
                                        <td style="width: 50px;"><a class="btn btn-danger" href="/cadastro/excluir/<?php echo $pessoa->PessoaID ?>" role="button">Excluir</a></td>
                                    </tr>
                                <?php
                            }
//                        }
                        $this->benchmark->mark('code_end');

                        echo $this->benchmark->elapsed_time('code_start', 'code_end');
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>