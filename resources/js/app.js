const modal = document.getElementById("searchModal");
const openBtn = document.querySelector(".search-btn");
const closeBtn = document.querySelector(".close-btn");
const input = document.getElementById("searchInput");
openBtn.onclick = () => {
    modal.classList.add("active");
    input.focus();
}
closeBtn.onclick = () => {
    modal.classList.remove("active");
}

modal.addEventListener("click", function(e){

    if(e.target === modal){

        modal.classList.remove("active");

    }

});


// max 768

const menuToggle = document.querySelector(".menu-toggle");
const menu = document.querySelector(".menu");
const overlay = document.querySelector(".overlay");

if (menuToggle) {
    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("active");
        overlay.classList.toggle("active");
    });
}

if (overlay) {
    overlay.addEventListener("click", () => {
        menu.classList.remove("active");
        overlay.classList.remove("active");
    });
}

 const userButton = document.getElementById('userButton');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    userButton.addEventListener('click', function (event) {
        event.stopPropagation();
        userDropdownMenu.classList.toggle('active');
    });

    document.addEventListener('click', function (event) {
        if (!userDropdownMenu.contains(event.target) &&
            !userButton.contains(event.target)) {
            userDropdownMenu.classList.remove('active');
        }
    });

