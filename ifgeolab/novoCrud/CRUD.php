<?php

class CRUD
{

    private $conexao ;


     // Função para conexão
    /*
        Obj Connection
        array "localhost", "root", "", "ifgeolab"

    */

    private function __contruct($conexao){
        $this->conectar($conexao);

    }

    // Função para conexão
    /*
        Obj Connection
        array "localhost", "root", "", "ifgeolab"

    */
    private function conectar($conexao = null)
    {

        if (is_array ($conexao)) {
            $this->conexao = mysqli_connect($conexao['host'], $conexao['host_name'], $conexao['pass'] );
            if ($conexao === false) {
                echo "Erro ao conectar à base de dados. Nº do erro: " . mysqli_connect_errno() . ". " . mysqli_connect_error();
                die();
            }
        }
        else {
            $this->conexao = $conexao;

        }
    
    }

    // Função para executar comandos SQL
    public function executarSQL($sql, $conexao = null)
    {

        $cAux = null;

        if ($conexao == null){
            $cAux = $this->conexao;
        }else 
        {
          $cAux = $conexao;  
        }

        $resultado = mysqli_query($cAux, $sql);
        if ($resultado === false) {
            echo "Erro ao executar o comando SQL. " . mysqli_errno($cAux) . ": " . mysqli_error($cAux);
            die();
        }
        return $resultado;
    }

    // cadastrar: Insere um novo registro na tabela
    public function cadastrar($tabela, $comando)
    {
        
        $conexao = $this->conectar();

        $coluna = implode(", ", array_keys($comando));
        $valores = implode(", ", array_map(fn($valores) => "'" . mysqli_real_escape_string($this->conexao, $valores) . "'", array_values($comando)));

        $sql = "INSERT INTO $tabela ($coluna) VALUES ($valores)";
        return $this->executarSQL($conexao, $sql);
    }

    // listar: Busca registros na tabela com base em condições
    public function listar($tabela, $condicao = [], $coluna = "*")
    {
        $conexao = $this->conectar();
        $sql = "SELECT $coluna FROM $tabela";

        if (!empty($condicao)) {
            $clausulas = [];
            foreach ($condicao as $key => $value) {
                $clausulas[] = "$key = '" . mysqli_real_escape_string($$this->conexao, $value) . "'";
            }
            $sql .= " WHERE " . implode(" AND ", $clausulas);
        }
        $result = $this->executarSQL($conexao, $sql);

        if (!$result) {
            die("Erro ao executar consulta: " . mysqli_error($this->conexao));
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    // editar: Atualiza registros na tabela
    public function editar($tabela, $comando, $condicao)
    {
        $conexao = $this->conectar();

        $set = implode(", ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($comando), $comando));
        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($condicao), $condicao));

        $sql = "UPDATE $tabela SET $set WHERE $where";
        return $this->executarSQL($conexao, $sql);
    }

    public function deletar($tabela, $condicao)
    {
        $conexao = $this->conectar();

        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($condicao), $condicao));
        $sql = "DELETE FROM $tabela WHERE $where";

        return $this->executarSQL($conexao, $sql);
    }
}
