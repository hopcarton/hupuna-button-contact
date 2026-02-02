document.addEventListener('DOMContentLoaded', function () {
    // Toggle danh sách nút con
    const mainBtn = document.querySelector('.hbc-main');
    const items = document.querySelectorAll('.hbc-item');

    if (mainBtn) {
        mainBtn.addEventListener('click', function () {
            items.forEach(function (item) {
                if (item.style.display === 'none' || getComputedStyle(item).display === 'none') {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

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

// CF7 gửi thành công → tự đóng popup
document.addEventListener('wpcf7mailsent', function () {
    const popup = document.querySelector('.hbc-popup-overlay');
    if (popup) popup.classList.remove('active');
});