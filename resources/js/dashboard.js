const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');

if (hamburger && sidebar) {
    hamburger.addEventListener('click', function () {
        sidebar.classList.toggle('show');
    });
}

function updateDate() {
    const dateElement = document.getElementById('current-date');

    if (!dateElement) {
        return;
    }

    const today = new Date();

    dateElement.textContent = today.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
}

updateDate();

setInterval(updateDate, 60000);
