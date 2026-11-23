
const modal = document.getElementById('tarefasModal');
const modalData = document.getElementById('modalData');
const listaTarefas = document.getElementById('listaTarefas');

// Abre o modal com todas as tarefas do dia
function abrirModal(dia) {
    const tarefas = tasksDoMes[dia] ?? [];

    if (tarefas.length === 0) {
        return;
    }

    modalData.textContent = `Dia ${dia}`;
    listaTarefas.replaceChildren();

    tarefas.forEach(tarefa => {
        const card = document.createElement('div');
        const titulo = document.createElement('h3');
        const descricao = document.createElement('p');
        const status = document.createElement('span');

        const concluida = Number(tarefa.status) === 0;

        card.className = concluida
            ? 'tarefa-card concluida'
            : 'tarefa-card';

        titulo.textContent = tarefa.titulo ?? 'Sem título';

        descricao.textContent =
            tarefa.descricao ?? 'Sem descrição';

        status.className = 'tarefa-status';
        status.textContent = concluida
            ? 'Concluída'
            : 'Pendente';

        card.appendChild(titulo);
        card.appendChild(descricao);
        card.appendChild(status);

        listaTarefas.appendChild(card);
    });

    modal.classList.add('active');
    modal.setAttribute('aria-hidden', 'false');
}

// Fecha o modal
function fecharModal() {
    modal.classList.remove('active');
    modal.setAttribute('aria-hidden', 'true');
}

// Clique nos dias que possuem tarefas
document.querySelectorAll('.dia-botao').forEach(botao => {
    botao.addEventListener('click', () => {
        const dia = botao.dataset.dia;

        abrirModal(dia);
    });
});

// Fecha ao clicar fora do modal
modal.addEventListener('click', event => {
    if (event.target === modal) {
        fecharModal();
    }
});

// Fecha ao pressionar ESC
document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && modal.classList.contains('active')) {
        fecharModal();
    }
});
