<?php 
$nome = $_POST["Nome"];
$email = $_POST["Email"];
$telefone = $_POST["Telefone"];
$comentario = $_POST["Comentarios"];

$conexao = mysqli_connect ("localhost","root", "","sitepadoca_79");
echo $nome;
//function insereDados($conexao,$nome,$email,$telefone,$comentario){
//    $query = "INSERT INTO Formulario(Nome,Telefone)"
//    
//}


?>