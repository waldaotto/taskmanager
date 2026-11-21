
function openEditModal(button) {
    const modal = document.getElementById('editModal');

    document.getElementById('edit_id').value = button.dataset.id;
    document.getElementById('edit_titulo').value = button.dataset.titulo;
    document.getElementById('edit_descricao').value = button.dataset.descricao;
    document.getElementById('edit_data').value = button.dataset.data;
    document.getElementById('edit_status').value = button.dataset.status;

    modal.classList.add('active');
}

function openDeleteModal(button) {
    const modal = document.getElementById('deleteModal');

    document.getElementById('delete_id').value = button.dataset.id;
    document.getElementById('delete_title').textContent = button.dataset.titulo;

    modal.classList.add('active');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

// Fechar clicando fora do modal
document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(event) {
        if (event.target === this) {
            this.classList.remove('active');
        }
    });
});

// Fechar pressionando ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.classList.remove('active');
        });
    }
});
