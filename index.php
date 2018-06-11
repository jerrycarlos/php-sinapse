<?php
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 03/06/18
 * Time: 00:40
 */

/**
 * User constructor.
 * @param $id
 * @param $nome
 * @param $email
 * @param $login
 * @param $telefone
 * @param $senha
 */

?>

<html>
<header>
    <title>Formulario de cadastro</title>
</header>
<body>
    <form method="POST" action="registerUser.php">
        <label>nome:</label><input type="text" name="nome" id="nome"><br>
        <label>email:</label><input type="text" name="email" id="email"><br>
        <label>login:</label><input type="text" name="login" id="login"><br>
        <label>telefone:</label><input type="number" name="telefone" id="telefone"><br>
        <label>senha:</label><input type="password" name="senha" id="senha"><br>
        <input type="submit" value="Cadastrar" id="cadastrar">
    </form>

    <form method="POST" action="login.php">
        <label>email:</label><input type="text" name="email" id="email"><br>
        <label>senha:</label><input type="password" name="senha" id="senha"><br>
        <input type="submit" value="Login" id="login">
    </form>

    <form method="POST" action="http://jjdeveloper.000webhostapp.com/buscaNotas.php">
        <input type="submit" value="Buscar" id="buscar">
    </form>

    <form method="POST" action="minhasNotas.php">
        <label>user:</label><input type="number" name="userId" id="user"><br> 
        <input type="submit" value="Minhas Notas" id="myNotes">
    </form>

    <form method="POST" action="userActions.php">
        <label>user:</label><input type="number" name="userId" id="user"><br>
        <label>note:</label><input type="number" name="noteId" id="note"><br>
        <input type="submit" value="User Likes" id="likes">
    </form>

    <form method="POST" action="actionUser.php">
        <label>user:</label><input type="number" name="userId" id="user"><br>
        <label>note:</label><input type="number" name="noteId" id="note"><br>
        <label>açao:</label><input type="number" name="action" id="action"><br>
        <input type="submit" value="Action note" id="btAction">
    </form>
</body>
</html>
