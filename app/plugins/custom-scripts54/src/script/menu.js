document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("sub-menu-holder");
    const modalBtn = document.getElementById("sub-menu-opener");
    const burgerIcon = document.getElementById("hamburger");
    const overlay = document.querySelectorAll(".overlay");
    const menuLinks = modal.querySelectorAll("a");
    let open = false;

    const toggleModal = () => {
        open = !open;
        modal.classList.toggle("open", open);
        burgerIcon.classList.toggle("open", open);
        overlay.forEach(el => el.classList.toggle("show", open));
        modalBtn.classList.toggle("is-active", open);
        document.body.style.overflowY = open ? "hidden" : "auto";
    };

    modalBtn.addEventListener("click", toggleModal);

    menuLinks.forEach(link => {
        link.addEventListener("click", () => {
            modal.classList.remove("open");
            document.body.style.overflowY = "auto";
            open = false;
        });
    });
});
