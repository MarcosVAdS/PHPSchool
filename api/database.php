<?php

class database extends mysqli {

	# overwrite parent __construct
	public function __construct() {
		parent::__construct(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);

		# check if connect errno is set
		if (mysqli_connect_errno()) {
			throw new RuntimeException('Não posso acessar o banco de dados: ' . mysqli_connect_error());
		}
	}
	
	# fetches all result rows as an associative array, a numeric array, or both
	# mysqli_fetch_all (PHP 5 >= 5.3.0)
	public function fetch_all($query) {
		$result = parent::query($query);
		if ($result) {
			# check if mysqli_fetch_all function exist or not
			if(function_exists('mysqli_fetch_all')) {
				# NOTE: this below always gets error on certain live server
				# Fatal error: Call to undefined method mysqli_result::fetch_all() in /.../class_database.php on line 28
				return $result->fetch_all(MYSQLI_ASSOC);
			} else {
				# fall back to use while to loop through the result using fetch_assoc
				while($row = $result->fetch_assoc()) {
					$return_this[] = $row;
				}

				if ( @ $return_this ) return $return_this;
				else return array();
			}
		} 
		else {
			die ( self::get_error() );
		}
	}
	
	# fetch a result row as an associative array
	public function fetch_assoc($query) {
		$result = parent::query($query);
		if($result) {
			return $result->fetch_assoc();
		} else {
			# call the get_error function
			die ( self::get_error() );
			# or:
			# return $this->get_error();
		}
	}

	# fetch a result row as an associative array
	public function num_rows($query) {
		$result = parent::query($query);
		if ($result) {
			return $result->num_rows;
		} else {
			# call the get_error function
			die ( self::get_error() );
			# or:
			# return $this->get_error();
		}
	}

	# fetch a result row as an associative array
	public function field_info($query) {
		$result = parent::query($query);
		if($result) {
			return $result->fetch_fields();
		} else {
			# call the get_error function
			die ( self::get_error() );
			# or:
			# return $this->get_error();
		}
	}

	# display error
	public function get_error() {
		if( $this->errno || $this->error ) 
			return sprintf("{\"error\": \"(%d) %s\"}", $this->errno, $this->error);
	}
	
	# close
	public function __destruct() {
		parent::close();
		//echo "Destructor Called";
	}

	########
	# More #
	########

	public function insert() {
		$tabela = get_class($this);
		$atributos = array_keys(get_object_vars($this));
		$values = array_values(get_object_vars($this));
		$campos = null;
		$valores = null;
		$condicoes = null;
		$qtd_atributos = sizeof($atributos);
		for ($i=0; $i<$qtd_atributos; $i++) {
			if ( @ $values[$i] ) {
				if ( $campos ) $campos .= ",";
				$campos .= $atributos[$i];
				
				if ( $valores ) $valores .= ",";
				$valores .= "'".$values[$i]."'";
				
				if ($condicoes) $condicoes .= " and ";
				$condicoes .= $atributos[$i]."='".$values[$i]."'";
			}
		}
		
		$query = "INSERT INTO $tabela ($campos) VALUES ($valores)";
		
		$result = parent::query($query);
		if ($result) {
			return $this->insert_id;
		} else {
			# call the get_error function
			die ( self::get_error() );
			# or:
			# return $this->get_error();
		}
	}

	public function update($where=null) {
		$tabela    = get_class($this);
		$atributos = array_keys(get_object_vars($this));
		$values = array_values(get_object_vars($this));
		$expressao = null;
		$qtd_atributos = sizeof($atributos);
		for ($i=0; $i<$qtd_atributos; $i++) {
			if ( @ $values[$i] ) {
				if (! @$condicao ) $condicao = $atributos[$i] . "='" . $values[$i] . "'";
				if ( $expressao ) $expressao .= ",";
				$expressao .= $atributos[$i] . "='" . $values[$i] . "'";
			}
		}
		
		if ( $where ) $condicao = "$where";
		
		$query = "UPDATE $tabela SET $expressao WHERE $condicao";

		$result = parent::query($query);
		if($result) {
			return $result;
		} else {
			# call the get_error function
			die ( self::get_error() );
			# or:
			# return $this->get_error();
		}
	}

	public function delete() {	
		$tabela    = get_class($this);
		$atributos = array_keys(get_object_vars($this));
		$values = array_values(get_object_vars($this));
		$qtd_atributos = sizeof($atributos);
		for ($i=0; $i<$qtd_atributos; $i++) {		
			if ( @ $values[$i] && ! @ $condicao ) 
				$condicao = $atributos[$i] . "='" . $values[$i] . "'";
		}
		$query = "DELETE FROM $tabela WHERE $condicao";
		$result = parent::query($query);
		if ($result) {
			return $result;
		} else {
			# call the get_error function
			die ( self::get_error() );
			# or:
			# return $this->get_error();
		}
	}

	public function execute($query) {
		$result = parent::query($query);
		if($result) {
			return $result;
		} else {
			# call the get_error function
			die ( self::get_error() );
			# or:
			# return $this->get_error();
		}
	}

	public function getUpdateTime ( $tableName ) {
		if ( $tableName ) {
			$sql = "SELECT update_time
			FROM information_schema.tables
			WHERE table_schema = '".DB_DB."'
			AND table_name = '$tableName'";

			$rs = self::fetch_all($sql);
			return $rs[0]['update_time'];
		} else {
			return false;
		}
	}
		
	public function inSTR ($field, $search=null) {
		if ($search) {
			$search_exploded = explode ( " ", $search ); 
			$x = 0; 
			$condiction = null;
			foreach( $search_exploded as $search_each ) { 
				if( $condiction ) $condiction .= " AND ";
				$condiction .= "INSTR($field,'$search_each')>0";
			}
			return $condiction;
		} else {
			return true;
		}
	}

	public function saveLog ($transation, $id) {
		return $this->execute( "INSERT INTO transacao (transacao,idusuario) VALUES ('$transation', $id)" );
	}
	
}

?>