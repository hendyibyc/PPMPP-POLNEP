const selectAll = document.getElementById('selectAll');
const faqCheckboxes = document.querySelectorAll('.faq-checkbox');
const selectedCount = document.getElementById('selectedCount');
const openDeleteModal = document.getElementById('openDeleteModal');
const deleteModal = document.getElementById('deleteModal');
const cancelDelete = document.getElementById('cancelDelete');
const confirmDelete = document.getElementById('confirmDelete');
const deleteForm = document.getElementById('deleteForm');

function updateSelectedCount() {
    const checked = document.querySelectorAll(
        '.faq-checkbox:checked'
    );
    selectedCount.textContent =
        checked.length + ' dipilih';
    if (selectAll) {
        selectAll.checked =
            faqCheckboxes.length > 0 &&
            checked.length === faqCheckboxes.length;
    }
}

if (selectAll) {
    selectAll.addEventListener('change', function () {
        faqCheckboxes.forEach(function (checkbox) {
            checkbox.checked = selectAll.checked;
        });
        updateSelectedCount();
    });
}

faqCheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        updateSelectedCount();
    });

});

if (openDeleteModal) {
    openDeleteModal.addEventListener('click', function () {
        const checked = document.querySelectorAll(
            '.faq-checkbox:checked'
        );

        if (checked.length === 0) {
            alert(
                'Pilih FAQ yang ingin dihapus terlebih dahulu.'
            );
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
