<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH ?>home/dashboard.css">
</head>
<body>
    <main>
        <h1 class="hero-title">Bom dia <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? '' ?>!</h1>
        <section class="hero-section">
            <div class="today-tasks">
                <h2 class="hero-subtitle">
                    Tarefas para hoje
                </h2>
                <div class="group-tasks">
                    <?php
                    if(!empty($today_tasks)):
                    ?>
                        <?php
                        foreach($today_tasks as $task):
                        ?>

                            <div class="task-<?= $task['status'] == 1 ? 'pendente' : 'concluida' ?>">
                                <span class="task-title">
                                    <?= htmlspecialchars($task['titulo'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? "Tarefa #{$task['id']}" ?>
                                </span>
                                <span class="task-description">
                                    <?= htmlspecialchars($task['descricao'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? '...' ?>
                                </span>
                                <span class="task-data">
                                    <?= htmlspecialchars($task['data_task'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? '--/--/--' ?>
                                </span>
                                <span class="task-<?= $task['status'] == 1 ? 'pendente' : 'concluida' ?>">
                                    <?= htmlspecialchars($task['status'] == 1 ? 'Pendente' : 'Concluida', ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? '--/--/--' ?>
                                </span>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    <?php
                    else:
                    ?>
                        <span class="hero-message"></span>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <section class="hero-section">
            <div class="task-resume-group">
                <div class="block-resume">
                    <span class="total-tasks">
                        <h3>Total de tarefas</h3>
                        <?= htmlspecialchars($task_kpi['total'] ?? '0', ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? '0' ?>
                    </span>
                    <span class="total-tasks">
                        <h3>Tarefas concluídas</h3>
                        <?= htmlspecialchars($task_kpi['total_concluida'] ?? '0', ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? '0' ?>
                    </span>
                    <span class="total-tasks">
                        <h3>Tarefas pendentes</h3>
                        <?= htmlspecialchars($task_kpi['total_pendente'] ?? '0', ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8') ?? '0' ?>
                    </span>
                </div>
            </div>
        </section>
    </main>
</body>
</html>