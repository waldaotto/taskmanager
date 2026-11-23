
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($title ?? 'TaskManager', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></title>

    <link rel="icon" type="image/png" href="<?= IMG_PATH ?>icon.png">

    <link rel="stylesheet" href="<?= CSS_PATH ?>/layouts/header.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/home/home.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/fafa-icons/css/font-awesome.min.css">

    <script defer src="<?= JS_PATH ?>/menu.js"></script>
    <script defer src="<?= JS_PATH ?>/home.js"></script>
</head>

<body>

<header>
    <div class="logotipo-box">
        <a href="/">
            <img src="<?= IMG_PATH ?>icon.png" alt="Logo TaskManager">
            TaskManager
        </a>
    </div>

    <nav class="menu">
        <ul>
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="#beneficios">Benefícios</a></li>
            <li><a href="#cadastro">Cadastro</a></li>
            <li><a href="#contato">Contato</a></li>
            <li><a href="/auth">Entrar <i class="fa fa-arrow-right"></i></a></li>
        </ul>
    </nav>

    <button
        class="menu-toggle"
        type="button"
        aria-label="Abrir menu"
        aria-expanded="false"
        onclick="menuToggle()"
    >
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
</header>

<main>

    <!-- HERO -->
    <section id="sobre" class="sobre">

        <div class="hero-content" data-reveal>

            <h1 class="hero-title">
                Seu tempo é valioso.
                <span>Organize melhor cada momento.</span>
            </h1>

            <p class="hero-description">
                Organize suas tarefas, acompanhe seus compromissos
                e tenha mais controle sobre sua rotina.
                Tudo em um só lugar.
            </p>

            <div class="hero-actions">
                <a href="#cadastro" class="btn-primary">
                    Comece agora
                    <i class="fa fa-arrow-right"></i>
                </a>

                <a href="/auth" class="btn-secondary">
                    Já tenho uma conta
                </a>
            </div>

            <div class="hero-highlights">
                <div>
                    <i class="fa fa-check-circle"></i>
                    <span>Organização simples</span>
                </div>

                <div>
                    <i class="fa fa-calendar-check-o"></i>
                    <span>Controle da rotina</span>
                </div>
            </div>

        </div>

        <div class="hero-visual" data-reveal>

            <div class="visual-decoration visual-decoration-one"></div>
            <div class="visual-decoration visual-decoration-two"></div>

            <div class="visual-image">
                <img
                    src="<?= IMG_PATH ?>sobre-img-organizar.png"
                    alt="Ilustração de organização do tempo e conclusão de tarefas"
                >
            </div>

            
        </div>

    </section>


    <!-- BENEFÍCIOS -->
    <section id="beneficios" class="beneficios">

        <div class="section-heading" data-reveal>
            <span class="section-tag">Mais produtividade</span>

            <h2>
                Tudo o que você precisa
                <span>para se organizar.</span>
            </h2>

            <p>
                Tenha uma visão mais clara das suas atividades
                e transforme sua rotina em algo mais organizado.
            </p>
        </div>

        <div class="beneficios-grid">

            <article class="beneficio-card" data-reveal>
                <div class="beneficio-icon">
                    <i class="fa fa-tasks"></i>
                </div>

                <h3>Gerencie suas tarefas</h3>

                <p>
                    Registre suas atividades, acompanhe o que precisa
                    ser feito e marque suas tarefas concluídas.
                </p>
            </article>

            <article class="beneficio-card" data-reveal>
                <div class="beneficio-icon">
                    <i class="fa fa-calendar"></i>
                </div>

                <h3>Organize sua agenda</h3>

                <p>
                    Visualize suas atividades por data e tenha
                    mais controle sobre seus compromissos.
                </p>
            </article>

            <article class="beneficio-card" data-reveal>
                <div class="beneficio-icon">
                    <i class="fa fa-line-chart"></i>
                </div>

                <h3>Acompanhe seu progresso</h3>

                <p>
                    Identifique suas pendências e acompanhe
                    o avanço das suas atividades.
                </p>
            </article>

        </div>

    </section>


    <!-- DESTAQUE -->
    <section class="destaque">

        <div class="destaque-content" data-reveal>

            <span class="section-tag">Uma rotina mais leve</span>

            <h2>
                Menos tempo tentando se organizar.
                <span>Mais tempo fazendo acontecer.</span>
            </h2>

            <p>
                Centralize suas tarefas e compromissos em um único lugar.
                Planeje seu dia com clareza, acompanhe suas prioridades
                e não deixe suas atividades se perderem no caminho.
            </p>

            <a href="#cadastro" class="btn-primary">
                Quero me organizar
                <i class="fa fa-arrow-right"></i>
            </a>

        </div>

        <div class="destaque-icon" data-reveal>
            <i class="fa fa-hourglass-half"></i>
        </div>

    </section>


    <!-- CADASTRO -->
    <section id="cadastro" class="cadastro">

        <div class="cadastro-info" data-reveal>

            <span class="section-tag">Dê o primeiro passo</span>

            <h2>
                Comece a organizar
                <span>seu tempo hoje.</span>
            </h2>

            <p>
                Dê o primeiro passo para uma rotina mais produtiva.
                Conheça o TaskManager e descubra uma maneira mais
                simples de acompanhar suas atividades.
            </p>

            <div class="cadastro-benefits">
                <div>
                    <i class="fa fa-check"></i>
                    <span>Organize suas atividades</span>
                </div>

                <div>
                    <i class="fa fa-check"></i>
                    <span>Acompanhe suas pendências</span>
                </div>

                <div>
                    <i class="fa fa-check"></i>
                    <span>Tenha mais controle da sua rotina</span>
                </div>
            </div>

        </div>

        <div class="login" data-reveal>

            <div class="login-heading">
                <span class="login-icon">
                    <i class="fa fa-user-plus"></i>
                </span>

                <h3>Vamos começar?</h3>

                <p>Informe seus dados para continuar.</p>
            </div>

            <form action="auth/cadastro" method="GET">

                <label for="nome">Seu nome</label>

                <input
                    type="text"
                    name="nome"
                    id="nome"
                    placeholder="Como podemos te chamar?"
                    autocomplete="name"
                    required
                >

                <label for="email">Seu e-mail</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="seuemail@email.com"
                    autocomplete="email"
                    required
                >

                <button type="submit" class="btn-submit">
                    Continuar
                    <i class="fa fa-arrow-right"></i>
                </button>

            </form>

            <span class="login-footer">
                Já possui cadastro?
                <a href="/auth">Entre na sua conta</a>
            </span>

        </div>

    </section>


    <!-- CONTATO -->
    <section id="contato" class="contato">

        <div class="contato-content" data-reveal>

            <span class="section-tag">Estamos à disposição</span>

            <h2>Vamos conversar?</h2>

            <p>
                Tem alguma dúvida, sugestão ou encontrou algum problema?
                Entre em contato. Será um prazer ouvir você.
            </p>

            <a href="mailto:suporte@taskmanager.com" class="contato-link">
                <i class="fa fa-envelope"></i>
                suporte@taskmanager.com
            </a>

        </div>

    </section>

</main>


<footer class="footer">
    <div class="footer-content">
        <span>
            <i class="fa fa-clock-o"></i>
            TaskManager
        </span>

        <p>
            Organize seu tempo. Valorize seus momentos.
        </p>
    </div>

    <span class="footer-copy">
        &copy; <?= date('Y') ?> TaskManager. Todos os direitos reservados.
    </span>
</footer>

</body>
</html>
