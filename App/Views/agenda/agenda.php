
<?php
$tasksDoMes = $tasksDoMes ?? [];

$classesIntensidade = [
    1 => 'tarefas-1',
    2 => 'tarefas-2',
    3 => 'tarefas-3',
    4 => 'tarefas-4',
    5 => 'tarefas-5',
    6 => 'tarefas-6',
    7 => 'tarefas-7',
    8 => 'tarefas-8',
    9 => 'tarefas-9',
    10 => 'tarefas-10'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="<?= htmlspecialchars(JS_PATH, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>agenda.js"></script>
    <link rel="stylesheet" href="<?= htmlspecialchars(CSS_PATH, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>agenda/agenda.css">
</head>
<body>

<div class="agenda">

    <div class="topo">

        <a href="<?= htmlspecialchars($linkAnterior ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
            &laquo; Anterior
        </a>

        <h2>
            <?= htmlspecialchars($tituloMes ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
        </h2>

        <a href="<?= htmlspecialchars($linkProximo ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
            Próximo &raquo;
        </a>

    </div>

    <table>
        <thead>
            <tr>
                <?php foreach (($diasSemana ?? []) as $nome): ?>
                    <th>
                        <?= htmlspecialchars((string)($nome ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>

            <?php foreach (($semanas ?? []) as $semana): ?>
                <tr>

                    <?php foreach (($semana ?? []) as $celula): ?>

                        <?php if ($celula === null): ?>

                            <td class="vazio"></td>

                        <?php else: ?>

                            <?php
                                $dia = (int)($celula['dia'] ?? 0);
                                $hoje = !empty($celula['hoje']);

                                $tarefasDoDia = $tasksDoMes[$dia] ?? [];
                                $quantidade = count($tarefasDoDia);

                                $classeCor = $quantidade > 0
                                    ? ($classesIntensidade[min($quantidade, 10)] ?? '')
                                    : '';

                                $classes = trim(
                                    ($hoje ? 'hoje ' : '') .
                                    ($quantidade > 0 ? 'tem-tarefas ' . $classeCor : '')
                                );
                            ?>

                            <td class="<?= htmlspecialchars($classes, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">

                                <?php if ($quantidade > 0): ?>

                                    <button
                                        type="button"
                                        class="dia-botao"
                                        data-dia="<?= $dia ?>"
                                        aria-label="<?= $dia ?>: <?= $quantidade ?> tarefas"
                                    >
                                        <span class="numero-dia">
                                            <?= $dia ?>
                                        </span>

                                        <span class="quantidade-tarefas">
                                            <?= $quantidade ?>
                                            <?= $quantidade === 1 ? 'tarefa' : 'tarefas' ?>
                                        </span>
                                    </button>

                                <?php else: ?>

                                    <span class="numero-dia">
                                        <?= $dia ?>
                                    </span>

                                <?php endif; ?>

                            </td>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>


<!-- MODAL DE TAREFAS DO DIA -->

<div class="modal-overlay" id="tarefasModal" aria-hidden="true">

    <div class="modal">

        <div class="modal-topo">

            <div>
                <h2>Tarefas do dia</h2>
                <p id="modalData"></p>
            </div>

            <button
                type="button"
                class="modal-fechar"
                onclick="fecharModal()"
                aria-label="Fechar modal"
            >
                &times;
            </button>

        </div>

        <div class="modal-conteudo" id="listaTarefas">
        </div>

    </div>

</div>


<!-- DADOS DAS TAREFAS PARA O JAVASCRIPT -->

<script>
    const tasksDoMes = <?= json_encode(
        $tasksDoMes,
        JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT
    ) ?: '{}' ?>;
</script>



</body>
</html>
