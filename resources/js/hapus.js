document.addEventListener("DOMContentLoaded", function () {
    const selectAll = document.getElementById("selectAllKonten");
    const checkboxes = document.querySelectorAll(".konten-checkbox");
    const selectedCount = document.getElementById("selectedCount");
    const deleteButton = document.getElementById("btnDeleteSelected");
    const deleteForm = document.getElementById("formHapusKonten");
    const modal = document.getElementById("deleteModal");
    const cancelDelete = document.getElementById("cancelDelete");
    const confirmDelete = document.getElementById("confirmDelete");
    const singleDeleteForm = document.getElementById("singleDeleteForm");
    const singleDeleteButtons = document.querySelectorAll(".btn-delete-single");

    let pendingForm = null;

    function updateSelected() {
        const checked = document.querySelectorAll(".konten-checkbox:checked");
        const total = checked.length;

        selectedCount.textContent = total + " dipilih";
        deleteButton.disabled = total === 0;

        if (checkboxes.length > 0) {
            selectAll.checked = total === checkboxes.length;
            selectAll.indeterminate = total > 0 && total < checkboxes.length;
        } else {
            selectAll.checked = false;
            selectAll.indeterminate = false;
        }
    }

    function openModal(form) {
        pendingForm = form;
        modal.classList.add("show");
        modal.setAttribute("aria-hidden", "false");
    }

    function closeModal() {
        pendingForm = null;
        modal.classList.remove("show");
        modal.setAttribute("aria-hidden", "true");
    }

    if (selectAll) {
        selectAll.addEventListener("change", function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAll.checked;
            });

            updateSelected();
        });
    }

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            updateSelected();
        });
    });

    if (deleteForm) {
        deleteForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const checked = document.querySelectorAll(".konten-checkbox:checked");

            if (checked.length === 0) {
                return;
            }

            openModal(deleteForm);
        });
    }

    singleDeleteButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const id = button.dataset.id;

            if (!id || !singleDeleteForm) {
                return;
            }

            singleDeleteForm.action = "/konten/" + encodeURIComponent(id);
            openModal(singleDeleteForm);
        });
    });

    if (cancelDelete) {
        cancelDelete.addEventListener("click", function () {
            closeModal();
        });
    }

    if (confirmDelete) {
        confirmDelete.addEventListener("click", function () {
            if (pendingForm) {
                pendingForm.submit();
            }
        });
    }

    if (modal) {
        modal.addEventListener("click", function (event) {
            if (event.target.classList.contains("delete-modal-overlay")) {
                closeModal();
            }
        });
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });

    updateSelected();
});
