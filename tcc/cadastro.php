<?php
include('conexao.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($conn) || !$conn) {
    die('Erro de conexão: ' . (isset($conn) ? mysqli_connect_error() : 'variável $conn não definida'));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['nome'], $_POST['senha'], $_POST['tipo_usuario'])) {

    $email = trim($_POST['email']);
    $nome = trim($_POST['nome']);
    $senha = $_POST['senha'];
    $tipo_usuario = $_POST['tipo_usuario'];

    if ($email === '' || $nome === '' || $senha === '' || $tipo_usuario === '') {
        die('Todos os campos são obrigatórios.');
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Ajuste o nome da tabela aqui se for "usuarios" em vez de "usuario"
    $table = 'usuario';
    $sql = "INSERT INTO {$table} (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)";

    // imprime a query (como comentário HTML para não quebrar layout)
    echo "<!-- SQL prepare: {$sql} -->";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        // lista tabelas e colunas para diagnóstico
        $tables = [];
        $res = mysqli_query($conn, "SHOW TABLES");
        while ($row = mysqli_fetch_row($res)) $tables[] = $row[0];

        $cols = [];
        if (in_array($table, $tables)) {
            $r2 = mysqli_query($conn, "SHOW COLUMNS FROM `{$table}`");
            while ($c = mysqli_fetch_assoc($r2)) $cols[] = $c['Field'];
        }

        error_log('Prepare falhou: ' . mysqli_error($conn));
        echo '<pre style="color:red">';
        echo "Erro no banco (prepare): " . mysqli_error($conn) . "\n\n";
        echo "Tabelas no banco:\n" . implode(", ", $tables) . "\n\n";
        if (!empty($cols)) {
            echo "Colunas da tabela '{$table}':\n" . implode(", ", $cols) . "\n\n";
            echo "Se o nome da tabela/colunas for diferente, ajuste \$table ou os nomes de coluna.\n";
        } else {
            echo "A tabela '{$table}' não foi encontrada — verifique se o nome correto é 'usuario' ou 'usuarios'.\n";
        }
        echo '</pre>';
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'ssss', $nome, $email, $senha_hash, $tipo_usuario);
    if (!mysqli_stmt_execute($stmt)) {
        error_log('Execute falhou: ' . mysqli_stmt_error($stmt));
        die('Erro ao inserir usuário: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);

    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = 'login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro de Usuário - AvaliAtivo</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-600 via-purple-400 to-purple-600 flex items-center justify-center font-sans">

  <div class="bg-white bg-opacity-90 rounded-lg shadow-lg p-8 max-w-md w-full">
    <div class="flex flex-col items-center mb-6">
      <div class="w-16 h-16 runded-full bg-green-500 flex items-center justify-center mb-2 shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" role="img" aria-label="Ícone de formatura representando AvaliAtivo">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.75 12.083 12.083 0 015.84 10.578L12 14z" />
        </svg>
      </div>
      <h1 class="text-2xl font-semibold text-green-800">AvaliAtivo</h1>
      <p class="text-center text-gray-600 mt-1 text-sm">Cadastre-se para acessar o sistema</p>
    </div>
  
            
  
<form id="cadastro" class="space-y-5" method="POST" action="cadastro.php" novalidate>
  <div>
    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
    <input
      type="text"
      id="nome"
      name="nome"
      required
      placeholder="Digite seu nome completo"
      class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
      autocomplete="name"
    />
    <p id="nomeError" class="text-red-600 mt-1 text-xs hidden">Preencha seu nome completo.</p>
  </div>

  <div>
    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
    <input
      type="email"
      id="email"
      name="email"
      required
      placeholder="seu@email.com"
      class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
      autocomplete="email"
    />
    <p id="emailError" class="text-red-600 mt-1 text-xs hidden">Informe um e-mail válido.</p>
  </div>

  <div>
    <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
    <input
      type="password"
      id="senha"
      name="senha"
      required
      placeholder="********"
      class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
      autocomplete="new-password"
      minlength="6"
    />
    <p id="senhaError" class="text-red-600 mt-1 text-xs hidden">Senha deve ter no mínimo 6 caracteres.</p>
  </div>

  <div>
    <label for="tipo_usuario" class="block text-sm font-medium text-gray-700 mb-1">Tipo de usuário</label>
    <select
      id="tipo_usuario"
      name="tipo_usuario"
      required
      class="w-full border border-gray-300 rounded-md p-2 bg-white focus:outline-none focus:ring-2 focus:ring-green-400"
    >
      <option value="" disabled>Selecione o tipo de usuário</option>
      <option value="admin">Administrador</option>
      <option value="professor">Professor</option>
      <option value="aluno">Aluno</option>
    </select>
    <p id="tipo_usuarioError" class="text-red-600 mt-1 text-xs hidden">Selecione um tipo de usuário.</p>
  </div>

  <button
    type="submit"
    class="w-full bg-green-500 hover:bg-green-600 transition-colors duration-200 text-white font-medium py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400"
  >
    Cadastrar
  </button>
</form> 
    <p class="mt-4 text-center text-sm text-gray-600">
      Já possui uma conta?
      <a href="login.php" class="text-green-600 hover:underline">Faça login aqui</a>
    </p>
  </div>

</body>
</html>