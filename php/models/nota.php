<?php 
    class nota extends mysqli{
        public function inserir(){
            require_once "dbconnect.php";
            $this->valornota = (@ $_REQUEST['valornota']);
            $this->disciplina = (@ $_REQUEST['disciplina']);
            $this->aluno = (@ $_REQUEST['aluno']);
            $sql = "INSERT INTO nota (id_nota, valornota, disciplina, aluno) VALUES (1, '$this->valornota', '$this->disciplina', '$this->aluno')";
            
            if ($connection->query($sql) === TRUE){
                return "ok";
            }else{
                return $connection->connect_error;
            }
            $connection -> close();
        }

        public function fetch_all(){
            require_once "dbconnect.php";
            
            $sql = "SELECT * FROM nota";
            $saida = $connection->query($sql);
            if($saida->num_rows > 0){
                return $saida;
            }else{
                return $connection->connect_error;
            }
            $connection->close();
        }

        public function pesquisar(){
            require_once "dbconnect.php";
            $pesquisa = (@ $_REQUEST['pesquisa']);

            $sql = "SELECT $pesquisa FROM nota";
            $saida = $connection->query($sql);

            if($saida->num_rows >0){
                return $saida;
            }else{
                return $connection->connect_error;
            }
            $connection->close();
        }
    }
?>