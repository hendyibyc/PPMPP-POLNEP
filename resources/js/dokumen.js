const layananSearch = document.getElementById('layananSearch');
const layananCards = document.querySelectorAll('.layanan-card');

if (layananSearch) {
    layananSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();

        layananCards.forEach(function (card) {
            const title = card.dataset.title || '';

            if (title.includes(keyword)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
}
