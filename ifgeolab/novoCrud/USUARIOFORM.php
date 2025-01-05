<?php
class UsuarioForm extends Form
{
    private $crud;
    private $formtipo;

    public function __construct($formtipo, $action = "cadastrar.php")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        // Configuração inicial do formulário
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        // Construir o formulário
        $this->buildForm();
    }

    public function buildForm()
    {
        $this->addRow([
            $this->addInput(
                "text",
                "nome",
                "Nome",
                $dados['nome'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            ),
            $this->addInput(
                "text",
                "email",
                "Email",
                $dados['email'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            ),
            $this->addInput(
                "password",
                "senha",
                "Senha",
                $_SESSION['senha'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            ),
            $this->addInput(
                "text",
                "matricula",
                "Matrícula",
                $dados['matricula'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            ),
            $this->addInput(
                "text",
                "inst",
                "Instituição",
                $dados['instituto'] ?? '',
                ["class" => "validate", "required" => true],
                "s12"
            )
        ]);

        $this->addRow([
            $this->addInput(
                "custom",
                "",
                "Foto de Perfil",
                "",
                [
                    "html" => '<div class="img-area" data-img="">
                        <i class="bx bxs-cloud-upload icon"></i>
                        <h3>Envie uma Foto de Perfil</h3>
                        <p>A imagem não pode ser maior que <span>20MB</span></p>
                        <input name="arquivo" type="file" id="Capa" style="display: none;">
                        <img src="../img/usuarios/' . ($img ?? 'default.jpg') . '" class="minha-imagem materialboxed circle">
                        <h6>Foto atual</h6>
                     </div>'
                ],
                "s12"
            )
        ]);

        $this->addRow([
            $this->addInput(
                "submit",
                "cadastrarUsuario",
                "",
                "Cadastrar",
                ["class" => "waves-effect waves-light btn green"],
                "s12"
            )
        ]);
    }
}