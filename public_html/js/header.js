document.addEventListener('DOMContentLoaded', function() {
    const userMenu = document.querySelector('.user-menu');
    const dropdown = userMenu.querySelector('.dropdown');

    let hoverTimeout;

    function showDropdown() {
        clearTimeout(hoverTimeout);
        dropdown.style.display = 'block';
        dropdown.style.opacity = '1';
    }

    function hideDropdown() {
        hoverTimeout = setTimeout(() => {
            dropdown.style.opacity = '0';
            setTimeout(() => {
                dropdown.style.display = 'none';
            }, 300);
        }, 300);
    }

    userMenu.addEventListener('mouseenter', showDropdown);
    userMenu.addEventListener('mouseleave', hideDropdown);
    dropdown.addEventListener('mouseenter', showDropdown);
    dropdown.addEventListener('mouseleave', hideDropdown);
});
