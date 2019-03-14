<?php
    class Cadastro_model extends CI_Model {

        function __construct() {
            // Call the Model constructor
            parent::__construct();
    
            // novo banco de dados
            $this->cadastro = $this->load->database('db', TRUE);
        }


        public function retornarEstados() {
            $sql = "SELECT EstadoID, Sigla FROM Estados";
            $query = $this->cadastro->query($sql);
    
            return $query->result_object();
        }

        public function retornarPessoas() {
            $sql = "SELECT * FROM Pessoas AS P INNER JOIN Estados AS E ON E.EstadoID = P.EstadoID";
            $query = $this->cadastro->query($sql);
    
            return $query->result_object();
        }

        public function retornarPessoaEspecifica($idUsuario) {
            $sql = "SELECT * FROM Pessoas AS P INNER JOIN Estados AS E ON E.EstadoID = P.EstadoID WHERE PessoaID = " . $idUsuario;
            $query = $this->cadastro->query($sql);
    
            return $query->result_object();
        }

        public function retornarPessoaEspecificaPorNome($nomeUsuario) {
            $sql = "SELECT * FROM Pessoas AS P INNER JOIN Estados AS E ON E.EstadoID = P.EstadoID WHERE P.Nome like '%" . $this->cadastro->escape_like_str($nomeUsuario) . "%' OR P.Sobrenome like '%" . $this->cadastro->escape_like_str($nomeUsuario) . "%'";
            $query = $this->cadastro->query($sql);
    
            return $query->result_object();
        }

        public function gravarPessoa($pessoa){
            $data = array(
                'Nome' => $pessoa->primeiroNome,
                'Sobrenome' => $pessoa->ultimoNome,
                'Email' => $pessoa->email,
                'Senha' => $pessoa->senha,
                'EstadoID' => $pessoa->estado,
                'Cidade' => $pessoa->cidade,
                'Foto' => $pessoa->foto
            );

            try{
                $this->cadastro->insert('Pessoas', $data);
                ?>
                    <div class="alert alert-success">
                        <strong>Sucesso!</strong> usuario salvo com sucesso.
                    </div>
                <?php
            }catch(Exception $e){
                echo "erro no bd" . $e->getMessage();
            }
        }

        public function alterarPessoa($pessoa){
            $data = array(
                'Nome' => $pessoa->primeiroNome,
                'Sobrenome' => $pessoa->ultimoNome,
                'Email' => $pessoa->email,
                'Senha' => $pessoa->senha,
                'EstadoID' => $pessoa->estado,
                'Cidade' => $pessoa->cidade,
                'Foto' => $pessoa->foto
            );

            $this->cadastro->where('PessoaID', $pessoa->idPessoa);
            try{
                $this->cadastro->update('Pessoas', $data);
                ?>
                    <div class="alert alert-success">
                        <strong>Sucesso!</strong> usuario alterado com sucesso.
                    </div>
                <?php
            }catch(Exception $e){
                echo "erro no bd" . $e->getMessage();
            }
        }

        public function excluirPessoa($idUsuario){
            try{
                $this->cadastro->where('PessoaID', $idUsuario);
                $this->cadastro->delete('Pessoas');
                ?>
                    <div class="alert alert-success">
                        <strong>Sucesso!</strong> usuario deletado com sucesso.
                    </div>
                <?php
            }catch(Exception $e){
                echo "erro no delete" . $e->getMessage();
            }
        }

        public function teste(){
            $query = $this->cadastro->query('SELECT * FROM Pessoas');

            return $query;
        }

        public function contarPessoas() {
            return $this->cadastro->count_all("Pessoas");                  
        }
        
        public function contarPessoasPorBusca($busca) {
            
        $this->cadastro->select('*');
        $this->cadastro->from('Pessoas AS P');
        $this->cadastro->join('Estados AS E', 'P.EstadoID = E.EstadoID', 'INNER');
        //$this->cadastro->group_start();
        $this->cadastro->like('P.Nome', $this->cadastro->escape_like_str($busca));
        //$this->cadastro->or_like('P.Sobrenome',$this->cadastro->escape_like_str($nomeUsuario));
        //$this->cadastro->group_end();

        $query = $this->cadastro->get();

        return $query->num_rows();
        }

        public function achar_pessoas($limite, $comeca) {
 
            $this->cadastro->select('*');
            $this->cadastro->from('Pessoas AS P');
            $this->cadastro->join('Estados AS E', 'P.EstadoID = E.EstadoID', 'INNER');
            $this->cadastro->limit($limite, $comeca);
            $query = $this->cadastro->get();
      
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        }
        
        public function achar_pessoas_por_nome($limite, $comeca, $nomeUsuario) {
           
            
            $this->cadastro->select('*');
            $this->cadastro->from('Pessoas AS P');
            $this->cadastro->join('Estados AS E', 'P.EstadoID = E.EstadoID', 'INNER');
            $this->cadastro->group_start();
            $this->cadastro->like('P.Nome', $this->cadastro->escape_like_str($nomeUsuario));
            $this->cadastro->or_like('P.Sobrenome',$this->cadastro->escape_like_str($nomeUsuario));
            $this->cadastro->group_end();

            $this->cadastro->limit($limite, $comeca);
            $query = $this->cadastro->get();
      
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        }
        
        public function teste1($nome){
            $this->cadastro->select('P.Nome, P.Sobrenome, E.Sigla');
            $this->cadastro->from('Pessoas AS P');
            $this->cadastro->join('Estados AS E', 'P.EstadoID = P.EstadoID', 'INNER');
            $this->cadastro->where('P.Nome', $nome);  
            $this->cadastro->group_by('P.Nome');
                
            $query = $this->cadastro->get();
                
            if ($query->num_rows() > 0 ){
                $result_array = $query->result_array();
 
                return $result_array;
            }else{
                return false; // ERROR.
            }
        }
    }

    
?>
