<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH ?>auth/auth.css">
</head>
<body>
    <main>
        <h2>
            Cadastrar
        </h2>
        <div class="form-login">
            <form action="/auth/cadastro" method="post">
                <label for="nome">Seu nome de usuario</label>
                <input type="text" name="nome" id="nome" maxlength="20" placeholder="Ex: usuario" value="<?= $nome_fill ?? '' ?>">

                <label for="email">Seu e-mail</label>
                <input type="email" name="email" id="email" placeholder="Ex: seuemail@email.com" value="<?= $email_fill ?? '' ?>">

                <label for="senha">Sua senha</label>
                <input type="password" name="senha" id="senha">

                <label for="senha-confirm">Confirmar senha</label>
                <input type="password" name="senha-confirm" id="senha-confirm">

                <input type="submit" value="Criar conta">
            </form>
            <span>Já possuí uma conta? </span><a href="/auth"> Entrar</a>
        </div>
        <?php if (!empty($message)): ?>
        <div class="message-login">
            <span><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <?php endif; ?>
    </main>
</body>
</html>