document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('addDocumentButton');
    const addForm = document.getElementById('documentAddForm');
    const cancelAddButton = document.getElementById('cancelAddDocument');

    if (addButton && addForm) {
        addButton.addEventListener('click', function (event) {
            event.preventDefault();
            addForm.classList.add('active');
            addForm.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    }

    if (cancelAddButton && addForm) {
        cancelAddButton.addEventListener('click', function (event) {
            event.preventDefault();
            addForm.classList.remove('active');
        });
    }

    const editButtons = document.querySelectorAll('.document-edit-button');

    editButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const targetId = button.getAttribute('data-target');

            if (!targetId) {
                return;
            }

            const targetForm = document.getElementById(targetId);

            if (!targetForm) {
                return;
            }

            document.querySelectorAll('.document-edit-form').forEach(function (form) {
                if (form !== targetForm) {
                    form.classList.remove('active');
                }
            });

            targetForm.classList.toggle('active');

            if (targetForm.classList.contains('active')) {
                setTimeout(function () {
                    targetForm.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 100);
            }
        });
    });

    const cancelEditButtons = document.querySelectorAll('.cancel-edit-button');

    cancelEditButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const editForm = button.closest('.document-edit-form');

            if (editForm) {
                editForm.classList.remove('active');
            }
        });
    });
});
