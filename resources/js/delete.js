function openDeleteModal(id) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');

    form.action = "/konten/" + id;
    modal.classList.add('show');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}

const deleteModal = document.getElementById('deleteModal');

if (deleteModal) {
    deleteModal.addEventListener('click', function (event) {
        if (event.target === this) {
            closeDeleteModal();
        }
    });
}
