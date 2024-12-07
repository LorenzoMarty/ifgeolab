<?php

class CRUD
{
    private $conexao;

    public function __construct($conexao = null)
    {
        $this->conectar($conexao);
    }

    private function conectar($conexao = null)
    {
        if (is_array($conexao)) {
            $this->conexao = mysqli_connect(
                $conexao['host'],
                $conexao['username'],
                $conexao['pass'],
                $conexao['database']
            );

            if ($this->conexao === false) {
                die("Erro ao conectar à base de dados. Nº do erro: " . mysqli_connect_errno() . ". " . mysqli_connect_error());
            }
        } elseif ($conexao instanceof mysqli) {
            $this->conexao = $conexao;
        }
    }

    // Executar comandos SQL
    public function executarSQL($sql)
    {
        $resultado = mysqli_query($this->conexao, $sql);

        if ($resultado === false) {
            die("Erro ao executar o comando SQL. " . mysqli_errno($this->conexao) . ": " . mysqli_error($this->conexao));
        }

        return $resultado;
    }

    // Cadastrar
    public function cadastrar($tabela, $dados)
    {
        $coluna = implode(", ", array_keys($dados));
        $valores = implode(", ", array_map(fn($valor) => "'" . mysqli_real_escape_string($this->conexao, $valor) . "'", array_values($dados)));

        $sql = "INSERT INTO $tabela ($coluna) VALUES ($valores)";
        return $this->executarSQL($sql);
    }

    // Listar
    public function listar($tabela, $condicao = [], $coluna = "*")
    {
        $sql = "SELECT $coluna FROM $tabela";

        if (!empty($condicao)) {
            $clausulas = [];
            foreach ($condicao as $key => $value) {
                $clausulas[] = "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'";
            }
            $sql .= " WHERE " . implode(" AND ", $clausulas);
        }

        $result = $this->executarSQL($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Editar
    public function editar($tabela, $dados, $condicao)
    {
        $set = implode(", ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($dados), $dados));
        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($condicao), $condicao));

        $sql = "UPDATE $tabela SET $set WHERE $where";
        return $this->executarSQL($sql);
    }

    // Deletar
    public function deletar($tabela, $condicao)
    {
        $where = implode(" AND ", array_map(fn($key, $value) => "$key = '" . mysqli_real_escape_string($this->conexao, $value) . "'", array_keys($condicao), $condicao));
        $sql = "DELETE FROM $tabela WHERE $where";

        return $this->executarSQL($sql);
    }
}

class Form
{
    private $action;
    private $method;
    private $enctype;
    private $id;
    private $class;
    private $rows = [];

    public function __construct($action = "", $method = "POST", $enctype = "", $id = "", $class = "")
    {
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->id = $id;
        $this->class = $class;
    }

    public function addRow($inputs = [])
    {
        $this->rows[] = $inputs;
    }

    public function addInput($type, $name, $label = "", $value = "", $attributes = [], $colSize = "s12", $customClass = "input-field col")
    {
        return compact('type', 'name', 'label', 'value', 'attributes', 'customClass', 'colSize');
    }

    public function render()
    {
        $formHTML = "<form action='{$this->action}' method='{$this->method}' enctype='{$this->enctype}' id='{$this->id}' class='{$this->class}'>\n";

        foreach ($this->rows as $row) {
            $formHTML .= "\t<div class='row'>\n";
            foreach ($row as $input) {
                $attributesString = $this->parseAttributes($input['attributes']);
                $formHTML .= "\t\t<div class='{$input['customClass']} {$input['colSize']}'>\n";

                if ($input['type'] !== 'hidden' && !empty($input['label'])) {
                    $formHTML .= "\t\t\t<label for='{$input['name']}'>{$input['label']}</label>\n";
                }

                $formHTML .= "\t\t\t<input type='{$input['type']}' name='{$input['name']}' value='{$input['value']}' id='{$input['name']}' {$attributesString}>\n";
                $formHTML .= "\t\t</div>\n";
            }
            $formHTML .= "\t</div>\n";
        }

        $formHTML .= "</form>\n";
        return $formHTML;
    }

    private function parseAttributes($attributes)
    {
        $attributesString = "";
        foreach ($attributes as $key => $value) {
            $attributesString .= "{$key}='" . htmlspecialchars($value) . "' ";
        }
        return $attributesString;
    }
}





