<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH ?>auth/auth.css">
</head>
    <body>
        <div class="login-container">
        <main>
            <h2>
                Log-in
            </h2>
            <div class="form-login">
                <form action="/auth" method="post">
                    <label for="email">Seu e-mail</label>
                    <input type="email" name="email" id="email" placeholder="Ex: seuemail@email.com" value="<?= $email_input ?? '' ?>" required>

                    <label for="senha">Sua senha</label>
                    <input type="password" name="senha" id="senha" required>

                    <input type="submit" value="Acessar">
                </form>
                <span>Não possuí uma conta? </span><a href="auth/cadastro"> Cadastre-se</a>
            </div>
            <?php if (!empty($message)): ?>
            <div class="message-login">
                <span><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <?php endif; ?>
        </main>
        </div>
    </body>
</html>