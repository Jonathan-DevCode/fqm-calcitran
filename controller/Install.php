<?php

class Install
{

    public function __construct()
    {
        // die();
    }
    public function up()
    {
        $this->admin_create();
        $this->participante_create();
        $this->pergunta_create();
        $this->alternativa_create();
        $this->participante_resposta_create();
    }
    public function admin_create()
    {
        $columns = [
            ['name' => 'id', 'type' => 'int(11)', 'key' => true],
            ['name' => 'login', 'type' => 'varchar(255)'],
            ['name' => 'senha', 'type' => 'varchar(255)'],
            ['name' => 'nome', 'type' => 'varchar(255)'],
            ['name' => 'permissao', 'type' => 'int'],
        ];
        (new DB)->create_table('admin', $columns);

        $with = [
            'login' => 'admin',
            'senha' => md5('admin'),
            'nome' => 'Administrador 01',
            'permissao' => 1
        ];
        (new Factory('admin'))->with($with)->save();
    }

    public function participante_create()
    {
        $columns = [
            ['name' => 'id', 'type' => 'int(11)', 'key' => true],
            ['name' => 'nome', 'type' => 'varchar(255)'],
            ['name' => 'funcao', 'type' => 'varchar(255)'],
            ['name' => 'cpf', 'type' => 'varchar(40)'],
            ['name' => 'farmacia', 'type' => 'varchar(255)'],
            ['name' => 'farmacia_cnpj', 'type' => 'varchar(24)'],
            ['name' => 'telefone', 'type' => 'varchar(18)'],
            ['name' => 'email', 'type' => 'varchar(255)'],
            ['name' => 'acertos', 'type' => 'int(1)'],
            ['name' => 'hora_voto', 'type' => 'datetime'],
            
        ];
        (new DB)->create_table('participante', $columns);
    }

   
    public function pergunta_create()
    {
        $columns = [
            ['name' => 'id', 'type' => 'int(11)', 'key' => true],
            ['name' => 'texto', 'type' => 'text'],
        ];
        (new DB)->drop_table('pergunta');
        (new DB)->create_table('pergunta', $columns);
    }

    public function alternativa_create()
    {
        $columns = [
            ['name' => 'id', 'type' => 'int(11)', 'key' => true],
            ['name' => 'texto', 'type' => 'text'],
            ['name' => 'indicador', 'type' => 'varchar(3)'],
            ['name' => 'correta', 'type' => 'int(1)', 'default' => '0'],
            ['name' => 'pergunta', 'type' => 'int'],
        ];
        (new DB)->drop_table('alternativa');
        (new DB)->create_table('alternativa', $columns);
    }

    public function participante_resposta_create()
    {
        $columns = [
            ['name' => 'id', 'type' => 'int(11)', 'key' => true],
            ['name' => 'participante', 'type' => 'int'],            
            ['name' => 'pergunta', 'type' => 'int'],
            ['name' => 'resposta', 'type' => 'int'],
            ['name' => 'certa', 'type' => 'int(1)', 'default' => '0'],
        ];
        (new DB)->drop_table('participante_resposta');
        (new DB)->create_table('participante_resposta', $columns);
    }

    // public function mock_create() {
    //     $with = [];
    //     for($i = 1; $i <= 20000; $i++) {
    //         $with[] = [
    //             "nome" => "participante {$i}",
    //             "funcao" => "testador",
    //             "cpf" => base64_encode(123),
    //             "farmacia" => "teste",
    //             "farmacia_cnpj" => "123",
    //             "telefone" => "(11) 11111-1111",
    //             "email" => "teste{$i}@teste.com",
    //             "acertos" => rand(0, 3),
    //             "hora_voto" => date("Y-m-d H:i:s")
    //         ];
    //     }
    //     (new Factory("participante"))->with($with)->save();
    // }

    // public function getSeed() {
    //     $participantes = (new Factory("participante"))->where("1 LIMIT 5000 OFFSET 15000")->get();
    //     echo "INSERT INTO participante (participante_nome, participante_funcao, participante_cpf, participante_farmacia, participante_farmacia_cnpj, participante_telefone, participante_email, participante_acertos, participante_hora_voto) VALUES ";
    //     $valuesParticipante = [];
    //     foreach($participantes as $p) {
    //         $valuesParticipante[] = "('$p->participante_nome', '$p->participante_funcao', '$p->participante_cpf', '$p->participante_farmacia', '$p->participante_farmacia_cnpj', '$p->participante_telefone', '$p->participante_email', '$p->participante_acertos', '$p->participante_hora_voto')";
    //     }
    //     $valuesParticipante = implode(",", $valuesParticipante);
    //     echo $valuesParticipante . ";";
    // }
}
