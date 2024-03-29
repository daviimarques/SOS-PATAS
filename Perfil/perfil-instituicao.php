
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
</head>

<body>
    <header>
        <!-- Cabeçalho -->
        <!---Imagem Logo-->
        <div id="img-cabecalho">
            <img id="img-logo" src="..//Imagens/Logotipo/cabeçalho.png" width="80" height="80" />
        </div>
        <!---Barra de navegação-->
        <nav id="menu-h">
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="..//tela inicial.html">INÍCIO</a></li>
                <li><a href="..//Sobre Nós/sobre_nós.html">SOBRE NÓS</a></li>
                <li><a href="..//noticias.html">NOTICIAS</a></li>
            </ul>
        </nav>
        <a href="..//Login/logout.php">Sair</a> <!-- Adicione um link "Sair" que redireciona para a página de logout -->
        <?php
        // Conectar com o MySQL usando a classe PDO
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "sospatas";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            session_start();
            $usuario_id = $_SESSION['user_id']; // Recupere o ID do usuário da sessão

            // Verificar se o ID do usuário existe no banco de dados
            $sql = "SELECT name FROM instituicoes WHERE usuario_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$usuario_id]);

        
        } catch (PDOException $e) {
            echo "<h1>Erro: " . $e->getMessage() . "</h1>";
        }
        ?>
    </header>

    <main>
<?php
   if ($stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $nome_instituicao = $result['name'];
    echo "<h1>Seja Bem-vindo $nome_instituicao</h1>";
} else {
    echo "<h1>Instituição não encontrada.</h1>";
}
?>
    </main>
</body>

</html>
