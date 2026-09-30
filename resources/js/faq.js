document.addEventListener('DOMContentLoaded', function () {
    const categoryToggles = document.querySelectorAll('.faq-toggle');

    categoryToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            const category = this.closest('.faq-category');
            category.classList.toggle('active');
        });
    });

    const questionButtons = document.querySelectorAll('.faq-question-button');

    questionButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const question = this.closest('.faq-question-item');
            question.classList.toggle('active');
        });
    });

    const searchInput = document.getElementById('faqSearch');

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        const categories = document.querySelectorAll('.faq-category');

        categories.forEach(function (category) {
            const categoryText = category.querySelector('.faq-category-left span:last-child').textContent.toLowerCase();
            const questions = category.querySelectorAll('.faq-question-item');
            let found = false;

            questions.forEach(function (question) {
                const questionText = question.querySelector('.faq-question-button span').textContent.toLowerCase();
                const answerText = question.querySelector('.faq-question-answer').textContent.toLowerCase();

                if (
                    keyword === '' ||
                    categoryText.includes(keyword) ||
                    questionText.includes(keyword) ||
                    answerText.includes(keyword)
                ) {
                    question.style.display = 'block';
                    found = true;
                } else {
                    question.style.display = 'none';
                }
            });

            if (keyword !== '' && found) {
                category.style.display = 'block';
                category.classList.add('active');
            } else if (keyword === '') {
                category.style.display = 'block';
                category.classList.remove('active');

                questions.forEach(function (question) {
                    question.style.display = 'block';
                    question.classList.remove('active');
                });
            } else {
                category.style.display = 'none';
            }
        });
    });
});
