const selectAll = document.getElementById('selectAll');
const documentCheckboxes = document.querySelectorAll('.document-checkbox');
const selectedCount = document.getElementById('selectedCount');
const openDeleteModal = document.getElementById('openDeleteModal');
const deleteModal = document.getElementById('deleteModal');
const cancelDelete = document.getElementById('cancelDelete');
const confirmDelete = document.getElementById('confirmDelete');
const deleteForm = document.getElementById('deleteForm');

function updateSelectedCount() {
    const checked = document.querySelectorAll('.document-checkbox:checked');

    selectedCount.textContent = checked.length + ' dipilih';

    if (selectAll) {
        selectAll.checked =
            documentCheckboxes.length > 0 &&
            checked.length === documentCheckboxes.length;
    }
}

if (selectAll) {
    selectAll.addEventListener('change', function () {
        documentCheckboxes.forEach(function (checkbox) {
            checkbox.checked = selectAll.checked;
        });

        updateSelectedCount();
    });
}

documentCheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        updateSelectedCount();
    });
});

if (openDeleteModal) {
    openDeleteModal.addEventListener('click', function () {
        const checked = document.querySelectorAll('.document-checkbox:checked');

        if (checked.length === 0) {
            alert('Pilih dokumen yang ingin dihapus terlebih dahulu.');
            return;
        }

        deleteModal.classList.add('show');
    });
}

if (cancelDelete) {
    cancelDelete.addEventListener('click', function () {
        deleteModal.classList.remove('show');
    });
}

if (confirmDelete) {
    confirmDelete.addEventListener('click', function () {
        if (deleteForm) {
            deleteForm.submit();
        }
    });
}

if (deleteModal) {
    deleteModal.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            deleteModal.classList.remove('show');
        }
    });
}

updateSelectedCount();
