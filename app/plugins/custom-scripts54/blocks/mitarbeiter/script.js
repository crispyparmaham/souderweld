document.addEventListener("DOMContentLoaded", () => {

    console.log('Das Mitarbeiterscript lädt');

    let galleries = document.querySelectorAll('.lightgallery');

    for (let gallery of galleries) {
        lightGallery(gallery, {
            selector: '.certificate-gallery-item',
            download: false,
            subHtmlSelectorRelative: true,
            licenseKey: 'F6EU6-2F2Q2-UYKX3-VGVVE',
        });
        //console.log(gallery);
    }

    // Finde alle Buttons mit der Klasse 'button-certificate'
    let buttons = document.querySelectorAll('.button-certificate');

    // Füge jedem Button den Klick-Handler hinzu
    for (let button of buttons) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let galleryName = button.getAttribute('data-gallery');
            let activeGallery = document.querySelector('.' + galleryName);
            let links = activeGallery.children;
            console.log(links);

            links[0].click();

        });
    }
});