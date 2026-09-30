document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.getElementById("hamburger");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("dashboardOverlay");

    function openSidebar() {
        if (sidebar) {
            sidebar.classList.add("active");
        }

        if (overlay) {
            overlay.classList.add("active");
        }

        document.body.classList.add("sidebar-open");
    }

    function closeSidebar() {
        if (sidebar) {
            sidebar.classList.remove("active");
        }

        if (overlay) {
            overlay.classList.remove("active");
        }

        document.body.classList.remove("sidebar-open");
    }

    if (hamburger) {
        hamburger.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();

            if (sidebar && sidebar.classList.contains("active")) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener("click", function () {
            closeSidebar();
        });
    }

    document.addEventListener("click", function (event) {
        if (!sidebar || !sidebar.classList.contains("active")) {
            return;
        }

        if (
            !sidebar.contains(event.target) &&
            hamburger &&
            !hamburger.contains(event.target)
        ) {
            closeSidebar();
        }
    });

    const openEditContent = document.getElementById("openEditContent");
    const closeEditContent = document.getElementById("closeEditContent");
    const editModal = document.getElementById("editModal");

    if (openEditContent && editModal) {
        openEditContent.addEventListener("click", function (event) {
            event.preventDefault();
            editModal.classList.add("active");
        });
    }

    if (closeEditContent && editModal) {
        closeEditContent.addEventListener("click", function () {
            editModal.classList.remove("active");
        });
    }

    if (editModal) {
        editModal.addEventListener("click", function (event) {
            if (event.target === editModal) {
                editModal.classList.remove("active");
            }
        });
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            if (editModal) {
                editModal.classList.remove("active");
            }
        }
    });
});
