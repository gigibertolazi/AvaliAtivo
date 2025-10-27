<?php
// Simulação de dados do professor - Substitua por dados reais ou de sessão mais tarde
$teacher_name = 'João Silva';  // Exemplo
$teacher_email = 'joao@escola.com';  // Exemplo
$teacher_subject = 'Matemática';  // Exemplo
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Perfil do Professor</title>
    <link rel="stylesheet" href="styleprofessor.css"> 
</head>
<body>
    <header>
        <img src="professor-e-servidor-publico-arraesecenteno.webp" alt="Foto de Perfil do Usuário">  <!-- Adicione aqui a imagem -->
        <h1>Bem-vindo, <?php echo htmlspecialchars($teacher_name); ?>!</h1>
        <p>Seu perfil e gerenciamento de aulas.</p>
    </header>
    
    <main>
        <section>
            <h2>Informações do Perfil</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($teacher_name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($teacher_email); ?></p>
            <p><strong>Disciplina:</strong> <?php echo htmlspecialchars($teacher_subject); ?></p>
            
            <!-- Formulário para editar perfil (opcional) -->
            <h3>Editar Perfil</h3>
            <form method="POST" action="update_profile.php">  <!-- Substitua por sua lógica de processamento -->
                <label for="new_email">Novo Email:</label>
                <input type="email" id="new_email" name="new_email" value="<?php echo htmlspecialchars($teacher_email); ?>">
                
                <label for="new_subject">Nova Disciplina:</label>
                <input type="text" id="new_subject" name="new_subject" value="<?php echo htmlspecialchars($teacher_subject); ?>">
                
                <button type="submit">Salvar Alterações</button>
                <button type="button" onclick="window.location.href='../avaliar.html'">Avaliar Aluno</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>Desenvolvido por [Seu Nome] - 2023</p>
    </footer>
</body>
</html>