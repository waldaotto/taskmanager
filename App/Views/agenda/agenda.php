
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda</title>
    <link rel="stylesheet" href="style.css">
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
                                $hoje = !empty($celula['hoje']);
                                $dia = $celula['dia'] ?? '';
                            ?>

                            <td class="<?= $hoje ? 'hoje' : '' ?>">
                                <?= htmlspecialchars((string)$dia, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                            </td>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>

</body>
</html>
