document.addEventListener('DOMContentLoaded', function () {
    // Popup CF7
    const btn = document.querySelector('.hbc-contact-btn');
    const popup = document.querySelector('.hbc-popup-overlay');

    if (btn && popup) {
        btn.addEventListener('click', function () {
            popup.classList.add('active');
        });
    }

    if (popup) {
        popup.addEventListener('click', function (e) {
            if (e.target === popup) {
                popup.classList.remove('active');
            }
        });
    }
});

// CF7 sent event to close popup
document.addEventListener('wpcf7mailsent', function () {
    const popup = document.querySelector('.hbc-popup-overlay');
    if (popup) popup.classList.remove('active');
});