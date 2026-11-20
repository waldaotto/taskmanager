<!DOCTYPE html>
<html lang="pt-bR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TaskManager' ?></title>
    <link rel="icon" type="image/png" href="<?= IMG_PATH ?>icon.png">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/layouts/header.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/fafa-icons/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="logotipo-box">
            <a href="/"><img src="<?= IMG_PATH ?>icon.png"> TaskManager</a>
        </div>

        <nav class="menu">
            <ul>
                <li>
                    <a href="/menu">Menu</a>
                </li>
                <li>
                    <a href="/tarefas">Tarefas</a>
                </li>
                <li>
                    <a href="/agenda">Agenda</a>
                </li>
            </ul>
        </nav>

        <a><?= $user ?? 'Guest' ?> <i class="fa fa-user-circle" aria-hidden="true"></i></a>
    </header>
</body>
</html>