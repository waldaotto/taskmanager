
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= CSS_PATH ?>tarefas/tarefas.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>tarefas/modal.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>../fafa-icons/css/font-awesome.min.css">
    <script defer src="<?= JS_PATH ?>tarefas.js"></script>

    <title>Minhas tarefas</title>
</head>
<body>

    <main>
        <!-- BUSCA -->
        <section>
            <div class="search">
                <form action="/tarefas" method="get" class="search-form">

                    <label for="filter">Buscar por:</label>

                    <select name="filter" id="filter" required>
                        <option value="titulo" selected>Título</option>
                        <option value="data">Data</option>
                    </select>

                    <input
                        type="text"
                        name="filter_value"
                        id="filter_value"
                        placeholder="Buscar tarefa..."
                    >

                    <input type="submit" value="Buscar">

                </form>
            </div>
        </section>

        <!-- LISTAGEM DE TAREFAS -->
        <section>
            <h1 class="hero-title">Tarefas</h1>

            <div class="tasks-group">

                <?php if (!empty($tasks)): ?>

                    <?php foreach ($tasks as $task): ?>

                        <div class="task <?= $task['status'] == 0 ? 'concluida' : 'pendente' ?>">

                            <span class="task-title">
                                <?= htmlspecialchars($task['titulo'] ?? 'Tarefa?', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                            </span>

                            <span class="task-description">
                                <?= htmlspecialchars($task['descricao'] ?? 'Sem descrição', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                            </span>

                            <span class="task-date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?= htmlspecialchars($task['data_task'] ?? '--/--/----', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                            </span>

                            <span class="task-status">
                                <?= $task['status'] == 0 ? 'Concluída' : 'Pendente' ?>
                            </span>

                            <div class="actions">

                                <!-- EDITAR -->
                                <button
                                    type="button"
                                    class="edit"
                                    onclick="openEditModal(this)"
                                    data-id="<?= htmlspecialchars((string)$task['id'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-titulo="<?= htmlspecialchars($task['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                    data-descricao="<?= htmlspecialchars($task['descricao'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                    data-data="<?= htmlspecialchars($task['data_task'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                    data-status="<?= htmlspecialchars((string)$task['status'], ENT_QUOTES, 'UTF-8') ?>"
                                    aria-label="Editar tarefa"
                                >
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>

                                <!-- EXCLUIR -->
                                <button
                                    type="button"
                                    class="delete"
                                    onclick="openDeleteModal(this)"
                                    data-id="<?= htmlspecialchars((string)$task['id'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-titulo="<?= htmlspecialchars($task['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                    aria-label="Excluir tarefa"
                                >
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>

                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="message">
                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                        <span>Nenhuma tarefa registrada.</span>
                    </div>

                <?php endif; ?>

            </div>
        </section>
    </main>


    <!-- =========================
         MODAL DE EDIÇÃO
    ========================== -->

    <div class="modal-overlay" id="editModal">

        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">

            <div class="modal-header">

                <h2 id="editModalTitle">Editar tarefa</h2>

                <button
                    type="button"
                    class="modal-close"
                    onclick="closeModal('editModal')"
                    aria-label="Fechar"
                >
                    &times;
                </button>

            </div>

            <form action="/tarefas/editar" method="POST" class="modal-form">

                <input type="hidden" name="id" id="edit_id">

                <label for="edit_titulo">Título</label>
                <input
                    type="text"
                    name="titulo"
                    id="edit_titulo"
                    placeholder="Título da tarefa"
                    required
                >

                <label for="edit_descricao">Descrição</label>
                <textarea
                    name="descricao"
                    id="edit_descricao"
                    placeholder="Descrição da tarefa"
                    rows="4"
                ></textarea>

                <label for="edit_data">Data</label>
                <input
                    type="date"
                    name="data_task"
                    id="edit_data"
                    required
                >

                <label for="edit_status">Status</label>
                <select name="status" id="edit_status" required>
                    <option value="1">Pendente</option>
                    <option value="0">Concluída</option>
                </select>

                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn-cancel"
                        onclick="closeModal('editModal')"
                    >
                        Cancelar
                    </button>

                    <button type="submit" class="btn-confirm">
                        Salvar alterações
                    </button>

                </div>

            </form>
        </div>
    </div>


    <!-- =========================
         MODAL DE EXCLUSÃO
    ========================== -->

    <div class="modal-overlay" id="deleteModal">

        <div class="modal modal-delete" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">

            <div class="modal-header">

                <h2 id="deleteModalTitle">Excluir tarefa</h2>

                <button
                    type="button"
                    class="modal-close"
                    onclick="closeModal('deleteModal')"
                    aria-label="Fechar"
                >
                    &times;
                </button>

            </div>

            <form action="/tarefas/excluir" method="POST">

                <input type="hidden" name="id" id="delete_id">

                <p class="delete-message">
                    Tem certeza de que deseja excluir a tarefa
                    <strong id="delete_title"></strong>?
                </p>

                <span class="delete-warning">
                    Essa ação não poderá ser desfeita.
                </span>

                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn-cancel"
                        onclick="closeModal('deleteModal')"
                    >
                        Cancelar
                    </button>

                    <button type="submit" class="btn-delete">
                        Excluir tarefa
                    </button>

                </div>

            </form>
        </div>
    </div>


</body>
</html>
