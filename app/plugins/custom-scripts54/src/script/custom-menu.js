document.addEventListener("DOMContentLoaded", () => {

    /*ADD MENU TEXT*/
    let pltSubMenuEls = document.querySelectorAll(".menu-item-has-children");
    for (const menuEl of pltSubMenuEls) {
        let subMenu = menuEl.querySelector(".souderweld-custom-sub-menu");
        let text = menuEl.querySelector("a").innerText;
        let link = menuEl.querySelector("a").getAttribute("href");

        let newTextEl = document.createElement("a");
        newTextEl.setAttribute("href", link)
        newTextEl.classList.add("sub-menu-desc");
        let newContent = document.createTextNode(text);
        newTextEl.appendChild(newContent)

    }

})