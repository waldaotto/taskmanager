
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?= CSS_PATH . 'errors.css'; ?>">
</head>
<body>
    <main>
        <div>
            <h1>ERRO</h1>
            <h3>Código 404</h3>
            <p><?= htmlspecialchars($message ?? 'ERRO',ENT_QUOTES,'UTF-8') ?></p>
        </div>
    </main>
</body>
</html>