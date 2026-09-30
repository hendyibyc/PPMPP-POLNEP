document.addEventListener('DOMContentLoaded', function () {
    const btnTambahFaq = document.getElementById('btnTambahFaq');
    const formTambahFaq = document.getElementById('formTambahFaq');
    const btnBatalTambah = document.getElementById('btnBatalTambah');

    if (btnTambahFaq && formTambahFaq) {
        btnTambahFaq.addEventListener('click', function () {
            formTambahFaq.classList.toggle('show');

            if (formTambahFaq.classList.contains('show')) {
                formTambahFaq.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    if (btnBatalTambah && formTambahFaq) {
        btnBatalTambah.addEventListener('click', function () {
            formTambahFaq.classList.remove('show');
        });
    }

    const categoryButtons = document.querySelectorAll('[data-category-toggle]');
    categoryButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const category = button.closest('.faq-category');
            if (!category) {
                return;
            }
            category.classList.toggle('open');
        });
    });

    const editButtons = document.querySelectorAll('[data-edit-faq]');
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const id = button.getAttribute('data-edit-faq');
            const form = document.getElementById('editFaq' + id);
            if (!form) {
                return;
            }

            document.querySelectorAll('.faq-edit-form.show').forEach(function (item) {
                if (item !== form) {
                    item.classList.remove('show');
                }
            });

            form.classList.toggle('show');
            if (form.classList.contains('show')) {
                form.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    });

    const cancelButtons = document.querySelectorAll('[data-cancel-edit]');
    cancelButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const id = button.getAttribute('data-cancel-edit');
            const form = document.getElementById('editFaq' + id);
            if (form) {
                form.classList.remove('show');
            }
        });
    });
});
