<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #334155;
        }
        
        .hero-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .input-field:focus {
            border-color: #954adb;
            box-shadow: 0 0 0 3px rgba(40, 238, 0, 0.08);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #77d36b 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .link-text {
            color: #55df9a;
            transition: all 0.2s ease;
        }
        
        .link-text:hover {
            color: #903dc7;
            text-decoration: underline;
        }
        
        .error-message {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .checkbox:checked {
            background-color: #b346e5;
            border-color: #9900ff;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Hero Section -->
        <div class="hero-bg lg:w-1/2 flex flex-col justify-center items-center p-10 text-white">
            <div class="max-w-md">
                <h1 class="text-4xl font-bold mb-4">Bem-vindo de volta!</h1>
                <p class="text-lg opacity-90 mb-8">
                    Faça login para acessar sua conta e continuar de onde parou. Mantenha seus dados seguros e protegidos conosco.
                </p>
                <div class="flex justify-center mb-8">
                    <img src="https://placehold.co/600x400" alt="Ilustração de uma pessoa usando um laptop com ícones de segurança e login flutuando ao redor" class="rounded-lg shadow-xl" />
                </div>
                <div class="flex flex-wrap gap-4 justify-center">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-green-400 mr-2"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-400 mr-2"></div>
                    </div>
                </div>
            </div>
        </div>
  <!-- Login Form -->
        <div class="lg:w-1/2 flex flex-col justify-center p-8 sm:p-12 md:p-16 bg-white">
            <div class="max-w-md w-full mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Entre na sua conta</h2>
                    <p class="text-gray-600">Informe seus dados para acessar o sistema</p>
                </div>
                
                <form id="loginForm" class="space-y-6" method="POST" action="login.php">
                    <div id="errorMessage" class="<?php echo $login_error ? 'bg-red-50 text-red-600 p-4 rounded-lg error-message' : 'hidden'; ?>">
    <?php echo htmlspecialchars($login_error); ?>
</div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                placeholder="seu@email.com"
                                class="pl-10 input-field w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required
                            />
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                            <a href="#" class="text-sm link-text">Esqueceu a senha?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="senha"
                                placeholder="••••••••"
                                class="pl-10 input-field w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required
                            />
                            <button type="button" class="absolute right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" id="togglePassword" aria-label="Alternar visibilidade da senha">
                                <svg id="eyeIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember-me" 
                                name="remember-me" 
                                type="checkbox" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded checkbox"
                            />
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Lembrar de mim
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <button 
                            type="submit" 
                            class="btn-primary w-full py-3 px-4 rounded-lg text-white font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Entrar
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 text-center">
                    <p class="text-gray-600">
                        Ainda não tem uma conta?
                        <a href="cadastro.php" class="link-text font-medium">Crie uma agora</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginForm = document.getElementById('loginForm');
        const errorMessage = document.getElementById('errorMessage');
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        // Toggle password visibility
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Simple icon swap
            if (type === 'text') {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242" />';
            } else {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        });

        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.classList.remove('hidden');
        }

        function hideError() {
            errorMessage.classList.add('hidden');
            errorMessage.textContent = '';
        }

        loginForm.addEventListener('submit', function (e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            // Validação simples
            if (!email || !password) {
                e.preventDefault();
                showError('Por favor, preencha todos os campos.');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                showError('Por favor, insira um email válido.');
                return;
            }

            if (password.length < 6) {
                e.preventDefault();
                showError('A senha deve ter pelo menos 6 caracteres.');
                return;
            }

            // Tudo ok: permite envio ao servidor (testLogin.php)
            hideError();
            // opcional: desabilitar botão para evitar múltiplos envios
            // this.querySelector('button[type="submit"]').disabled = true;
        });
    });
    </script>
    <?php
    include_once('conexao.php');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();

    $login_error = '';

    // Ajuste o nome da tabela se necessário: 'usuario' ou 'usuarios'
    $table = 'usuario';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        $sql = "SELECT id, nome, email, senha, tipo_usuario FROM `$table` WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if ($result && $usuario = mysqli_fetch_assoc($result)) {
                    if (password_verify($senha, $usuario['senha'])) {
                        $_SESSION['user_id'] = $usuario['id'];
                        $_SESSION['user_nome'] = $usuario['nome'];
                        $_SESSION['user_tipo'] = $usuario['tipo_usuario'];
                        header('Location: paginaprof.php');
                        exit;
                    }
                }
                $login_error = 'Email ou senha incorretos.';
            } else {
                error_log('Execute falhou (login): ' . mysqli_stmt_error($stmt));
                $login_error = 'Erro no servidor. Tente novamente mais tarde.';
            }
            mysqli_stmt_close($stmt);
        } else {
            error_log('Prepare falhou (login): ' . mysqli_error($conn));
            $login_error = 'Erro no servidor. Tente novamente mais tarde.';
        }
    }
?>

</body>
</html>
