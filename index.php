<?php

require_once ("config.php");

/*
Carrega um usuário.
$root = new Usuario();
$root->loadbyId(3);
echo $root;
*/

//Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários buscando, pelo login.
//$search = Usuario::search("jo");
//echo json_encode($search);

//Carrega um usuário usando um login e senha.
//$usuario = new Usuario();
//$usuario->login("root", "!@#$");
//echo $usuario;

//criando um novo usuário
//$aluno = new Usuario("aluno", "@lun0");
//$aluno->insert();
//echo $aluno;

/*Alterar um usuário
$usuario = new Usuario();
$usuario->loadbyId(17);
$usuario->update("professor", "!@#$&");
echo $usuario;
*/

$usuario = new Usuario();

$usuario->loadbyId(17);

$usuario->delete();

echo $usuario;

?>