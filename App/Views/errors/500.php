
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH . 'errors/errors.css'; ?>">
</head>
<body>
    <main>
        <div class="error-container">
            <h1>ERRO</h1>
            <h3>Código 500</h3>
            <p><?= htmlspecialchars($message ?? 'erro',ENT_QUOTES,'UTF-8') ?></p>
            <a href="/"><- Voltar</a>   
        </div>
    </main>
</body>
</html>