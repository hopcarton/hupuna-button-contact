document.addEventListener('DOMContentLoaded', function () {
    // Popup CF7
    const contactBtn = document.querySelector('.hbc-contact-btn');
    const popupOverlay = document.querySelector('.hbc-popup-overlay');

    if (contactBtn && popupOverlay) {
        contactBtn.addEventListener('click', function (e) {
            e.preventDefault();
            popupOverlay.classList.add('active');
        });

        // Close when clicking outside of the popup content
        popupOverlay.addEventListener('click', function (e) {
            if (e.target === popupOverlay) {
                popupOverlay.classList.remove('active');
            }
        });
    }

    // CF7 sent event to close popup (Vanilla JS)
    document.addEventListener('wpcf7mailsent', function () {
        if (popupOverlay) popupOverlay.classList.remove('active');
    }, false);
});