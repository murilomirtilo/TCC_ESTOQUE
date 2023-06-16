<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../tucano (1).png" type="image/png">
    <title>Entrar</title>
</head>

<body>
<!-- SIDE BAR TOOOOOOOOMA-LE mutuário -->



    <div class="container">
        <!-- fazer login -->
        <div class="login-wrap active">
            <div class="title">
                <h1>Entrar</h1>
            </div>

            <form method="POST" action="logar.php">
                <div class="input-area">
                    <input type="text" name="login1" id="email" autocomplete="off" required>
                    <label for="email">Login</label>
                </div>

                <div class="input-area">
                    <input type="password" name="senha1" id="password" required>
                    <label for="password">Senha</label>
                </div>



                <div class="button-area">
                    <button type="submit" class="login-btn">Entrar</button>
                </div>
            </form>

            <div class="form-toggle-area">
                <p>Nâo tem uma conta? <span id="toggle-signup">Inscreva-se</span></p>
            </div>
        </div>


        <!-- cadastrar usuario -->
        <div class="signup-wrap">
            <div class="title">
                <h1>Se inscreva</h1>
            </div>

            <form method="POST" action="cadastrar.php">
                <div class="input-area">
                    <input type="text" name="login" id="name" autocomplete="off" required>
                    <label for="name">Login</label>
                </div>

                <div class="input-area">
                    <input type="email" name="email" id="email" autocomplete="off" required>
                    <label for="email">Email</label>
                </div>

                <div class="input-area">
                    <input type="password" name="senha" id="password" required>
                    <label for="password">Senha</label>
                </div>

                <div class="button-area">
                    <button type="submit" class="signup-btn">Cadastrar</button>
                </div>
            </form>

            <div class="form-toggle-area">
                <p>Já possui uma conta? <span id="toggle-login">Entre agora</span></p>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');

* {
    margin: 0;
    padding: 0;
    font-family: 'Ubuntu', sans-serif;
}

body {
    display: flex;
    width: 100%;
    height: 100vh;
    align-items: center;
    justify-content: center;
    background: linear-gradient(45deg, rgba(75, 33, 33, 0.13), rgba(0, 0, 0, 0.7)), url('imagens/bg_img.jpg');
    background-size: cover;
    background-position: center;
    overflow: hidden;
}

.container {
    position: relative;
    height: 600px;
    flex-basis: 390px;
}

.login-wrap,
.signup-wrap {
    padding: 2rem 1rem;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -90%);
    height: auto;
    width: 100%;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    box-sizing: border-box;
    transition: all 0.4s ease;
}

.active {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translate(-50%, -50%);
}

.title h1 {
    padding-bottom: 1.2rem;
    position: relative;
    color: #fff;
    font-size: 2.8rem;
    text-align: center;
}

.title h1::before {
    position: absolute;
    content: '';
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 0.8rem;
    width: 7rem;
    background: #eb3023;
    border-radius: 1rem;
    clip-path: polygon(0 0, 0% 100%, 100% 0);
}

form {
    margin-top: 3rem;
}

.input-area {
    margin-top: 2.4rem;
    position: relative;
    display: grid;
    place-items: center;
}

.input-area input {
    width: 90%;
    height: 3rem;
    color: #fff;
    font-size: 1.2rem;
    border: 2px solid #fff;
    border-radius: 2rem;
    outline: none;
    background: rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(1rem);
    padding: 0 1.4rem;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

.input-area input:focus {
    width: 100%;
}

.input-area label {
    position: absolute;
    top: 50%;
    left: 2.6rem;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.input-area input:focus~label {
    transform: translateY(-3rem);
    left: 1rem;
}

.input-area input:valid~label {
    transform: translateY(-3rem);
}

.forgot-pass {
    margin-top: 0.4rem;
    position: relative;
}

.forgot-pass a {
    position: absolute;
    top: 0;
    left: 2.6rem;
    color: #eff;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.forgot-pass a:hover {
    color: #eb3023;
}

.button-area {
    margin-top: 4rem;
    width: 100%;
    display: grid;
    place-items: center;
}

button {
    width: 8rem;
    height: 3rem;
    border: none;
    outline: none;
    color: #fff;
    font-size: 1.4rem;
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 2rem;
    background: #eb3023;
    transition: all 0.3s ease;
}

button:hover {
    width: 50%;
    letter-spacing: 2px;
    background: transparent;
    border: 2px solid #fff;
}

.form-toggle-area {
    margin-top: 3rem;
    display: flex;
    justify-content: center;
}

.form-toggle-area p {
    color: #eee;
    font-size: 1rem;
    text-align: center;
}

.form-toggle-area p span {
    color: #eff;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
}

.form-toggle-area p span:hover {
    color: #eb3023;
}

@media screen and (max-width: 360px) {
    .title h1 {
        font-size: 2.6rem;
    }

    .login-wrap,
    .signup-wrap {
        padding: 2rem 0.2rem;
    }

    .input-area input {
        font-size: 1.1rem;
    }

    .input-area label {
        font-size: 1.1rem;
    }

    button {
        font-size: 1.2rem;
    }

    .form-toggle-area p {
        font-size: 0.9rem;
    }
}

</style>
<script>
let loginForm = document.querySelector('.login-wrap');
let signupForm = document.querySelector('.signup-wrap');
let title = document.querySelector('title');

let signupToggleBtn = document.querySelector('#toggle-signup');
let loginToggleBtn = document.querySelector('#toggle-login');

signupToggleBtn.onclick = () => {
    loginForm.classList.remove('active');
    signupForm.classList.add('active');
    title.textContent = 'Signup form';
}

loginToggleBtn.onclick = () => {
    signupForm.classList.remove('active');
    loginForm.classList.add('active');
    title.textContent = 'Login form';
}

</script>
</html>
