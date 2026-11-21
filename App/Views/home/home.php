<!DOCTYPE html>
<html lang="pt-bR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TaskManager' ?></title>
    <link rel="icon" type="image/png" href="<?= IMG_PATH ?>icon.png">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/layouts/header.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/home/home.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/fafa-icons/css/font-awesome.min.css">
    <script defer src="<?= JS_PATH ?>/menu.js"></script>
</head>
<body>
    <header>
        <div class="logotipo-box">
            <a href="/">
                <img src="<?= IMG_PATH ?>icon.png">
                TaskManager
            </a>
        </div>

        <nav class="menu">
            <ul>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#cadastro">Cadastro</a></li>
                <li><a href="#contato">Contato</a></li>
                <li><a href="/auth">Entrar ></a></li>
            </ul>
        </nav>

        <button class="menu-toggle" aria-label="Abrir menu" onclick="menuToggle()">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
    </header>

    <main>
        <section id="sobre" class="sobre">
            <div class="cabecalho-sobre">
                <h1 class="hero-title">
                    Organize seu tempo 
                </h1>
                <h3 class="hero-subtitle">
                    Com o <?= htmlspecialchars($_ENV['APP_NAME'],ENT_QUOTES,'UTF-8') ?> o seu tempo vale mais!
                </h3>
            </div>
            <div class="corpo-sobre-img">
                <p class="hero-text">
                    O tempo é precioso! Gerencie tarefas e controle sua agenda.
                </p>
                <img src="<?= IMG_PATH ?>/sobre-img-organizar.png">

            </div>  

            <span class="hero-text">
                O TaskManager é uma ferramenta desenvolvida para facilitar a organização e o gerenciamento de tarefas e compromissos. Seu objetivo é centralizar atividades em um único ambiente, permitindo acompanhar pendências, organizar prioridades, planejar agendas e monitorar o progresso das atividades.
                Com uma interface simples e intuitiva, o sistema busca aumentar a produtividade, otimizar o gerenciamento do tempo e proporcionar mais controle sobre as tarefas do dia a dia.
            </span>    
        </section>

        <section id="cadastro" class="cadastro">
            <div class="login">
                <form action="/auth" method="get">
                    <label for="nome">Seu nome</label>
                    <input type="text" name="nome" id="nome" placeholder="seu nome">

                    <label for="email">Seu e-mail</label>
                    <input type="email" name="email" id="email" placeholder="Ex: meuemail@email.com">

                    <input type="submit" value="Enviar">
                </form>
            </div>
        </section>

       <section id="contato" class="contato">
            <div class="contato-content">
                <h2>Entre em contato</h2>

                <p>
                    Tem alguma dúvida, sugestão ou encontrou algum problema?
                    Estamos abertos a ouvir você!
                </p>

                <div class="contato-info">
                    <a href="mailto:suporte@taskmanager.com">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        E-mail
                    </a>
                </div>
            </div>
        </section>
    </main>

</body>
</html>