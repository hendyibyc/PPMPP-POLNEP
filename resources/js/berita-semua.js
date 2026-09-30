document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchBerita");
    const beritaList = document.getElementById("beritaList");
    const beritaTidakDitemukan = document.getElementById("beritaTidakDitemukan");

    if (!searchInput || !beritaList) {
        return;
    }

    const beritaItems = beritaList.querySelectorAll(".berita-item");

    searchInput.addEventListener("input", function () {
        const keyword = this.value.toLowerCase().trim();
        let jumlahDitemukan = 0;

        beritaItems.forEach(function (item) {
            const judul = item.querySelector(".berita-content h2")?.textContent.toLowerCase() || "";
            const isi = item.querySelector(".berita-content p")?.textContent.toLowerCase() || "";
            const cocok = judul.includes(keyword) || isi.includes(keyword);

            if (cocok) {
                item.style.display = "flex";
                jumlahDitemukan++;
            } else {
                item.style.display = "none";
            }
        });

        if (beritaTidakDitemukan) {
            if (jumlahDitemukan === 0) {
                beritaTidakDitemukan.style.display = "block";
            } else {
                beritaTidakDitemukan.style.display = "none";
            }
        }
    });
});
