jQuery(document).ready(function ($) {
    $('.hbc-main').on('click', function () {
        $('.hbc-item').toggle();
    });
});

document.addEventListener('DOMContentLoaded', function () {

    const btn = document.querySelector('.contact-btn');
    const popup = document.querySelector('.hbc-popup-overlay');
    const close = document.querySelector('.hbc-close');

    if (!btn || !popup) return;

    btn.onclick = () => popup.classList.add('active');
    close.onclick = () => popup.classList.remove('active');

    popup.onclick = e => {
        if (e.target === popup) popup.classList.remove('active');
    };
});

// CF7 gửi thành công → tự đóng popup
document.addEventListener('wpcf7mailsent', function () {
    const popup = document.querySelector('.hbc-popup-overlay');
    if (popup) popup.classList.remove('active');
});