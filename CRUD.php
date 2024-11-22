<?php

class CRUD
{
    // Função para conexão
    private function conectar()
    {
        $conexao = mysqli_connect("localhost", "root", "", "produtos");
        if ($conexao === false) {
            echo "Erro ao conectar à base de dados. Nº do erro: " . mysqli_connect_errno() . ". " . mysqli_connect_error();
            die();
        }
        return $conexao;
    }

    // Função para executar comandos SQL
    private function executarSQL($conexao, $sql)
    {
        $resultado = mysqli_query($conexao, $sql);
        if ($resultado === false) {
            echo "Erro ao executar o comando SQL. " . mysqli_errno($conexao) . ": " . mysqli_error($conexao);
            die();
        }
        return $resultado;
    }

    // CREATE: Insere um novo registro na tabela
    public function create($table, $comando)
    {
        $conexao = $this->conectar();

        $columns = implode(", ", array_keys($comando));
        $values = implode(", ", array_map(fn($value) => "'" . mysqli_real_escape_string($conexao, $value) . "'", array_values($comando)));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->executarSQL($conexao, $sql);
    }

    // READ: Busca registros na tabela com base em condições
    public function read($table, $conditions = [], $columns = "*")
    {
        $conexao = $this->conectar();

        $sql = "SELECT $columns FROM $table";
        if (!empty($conditions)) {
            $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($conexao, $value) . "'", array_keys($conditions), $conditions));
            $sql .= " WHERE $where";
        }

        $result = $this->executarSQL($conexao, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // UPDATE: Atualiza registros na tabela
    public function update($table, $comando, $conditions)
    {
        $conexao = $this->conectar();

        $set = implode(", ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($conexao, $value) . "'", array_keys($comando), $comando));
        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($conexao, $value) . "'", array_keys($conditions), $conditions));

        $sql = "UPDATE $table SET $set WHERE $where";
        return $this->executarSQL($conexao, $sql);
    }

    public function delete($table, $conditions)
    {
        $conexao = $this->conectar();

        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($conexao, $value) . "'", array_keys($conditions), $conditions));
        $sql = "DELETE FROM $table WHERE $where";

        return $this->executarSQL($conexao, $sql);
    }
}
