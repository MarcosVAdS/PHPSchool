<?php 
    class nota extends mysqli{
        public function inserir(){
            require_once "dbconnect.php";
            $this->disciplina = (@ $_REQUEST['disciplina']);
            $this->valornota = (@ $_REQUEST['valornota']);
            $this->aluno = (@ $_REQUEST['aluno']);
            $sql = "INSERT INTO nota (id_nota, valornota, disciplina, aluno) values (1, '$this->valornota', '$this->disciplina', '$this->aluno')";
            
            if ($connect->query($sql) === TRUE){
                return "ok";
            }else{
                return $connect->connect_error;
            }
            $connect -> close();

        }

        public function fetch_all(){
            require_once "dbconnect.php";
            
            $sql = "SELECT * from nota";
            $saida = $connection->query($sql);
            if($saida->num_rows > 0){
                return $out;
                echo 'retornou dados';
            }else{
                return $connection->connect_error;
            }
            $connection->close();
        }
    }
?>