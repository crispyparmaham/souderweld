function splitEnd() {
    var titles = document.querySelectorAll('.title');

    titles.forEach(function(title) {
        var heading = title.innerHTML;
        var wordArray = heading.split(/\s+/);
        var lastWord = wordArray.pop();
        var firstPart = wordArray.join(' ');

        title.innerHTML = [firstPart, ' <span class="last-word">', lastWord, '</span>'].join('');
    });
}


// import { initFaqTogglePanels } from "./misc/faq-toggle-panel";
document.addEventListener("DOMContentLoaded", () => {

    splitEnd();

})