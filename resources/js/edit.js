document.addEventListener("DOMContentLoaded", function () {
    const editBeritaButton = document.getElementById("editBeritaButton");
    const pilihanBerita = document.getElementById("pilihanBerita");

    if (editBeritaButton && pilihanBerita) {
        editBeritaButton.addEventListener("click", function () {
            pilihanBerita.classList.toggle("active");
            editBeritaButton.classList.toggle("active");
        });
    }

    const searchDetailBerita = document.getElementById("searchDetailBerita");
    const detailBeritaList = document.getElementById("detailBeritaList");

    if (searchDetailBerita && detailBeritaList) {
        const detailBeritaItems = detailBeritaList.querySelectorAll(".berita-detail-option");

        searchDetailBerita.addEventListener("input", function () {
            const keyword = searchDetailBerita.value.toLowerCase().trim();

            detailBeritaItems.forEach(function (item) {
                const judul = item.getAttribute("data-judul") || "";

                if (judul.includes(keyword)) {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
        });
    }
});
