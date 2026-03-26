document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const drawerClose = document.getElementById('drawerClose');
    const mobileDrawer = document.getElementById('mobileDrawer');
    const drawerOverlay = document.getElementById('drawerOverlay');
    const searchToggle = document.querySelector('.search-toggle');
    const searchBar = document.getElementById('searchBar');
    const scrollTop = document.getElementById('scrollTop');

    function openDrawer() {
        if (mobileDrawer) mobileDrawer.classList.add('active');
        if (drawerOverlay) drawerOverlay.classList.add('active');
    }

    function closeDrawer() {
        if (mobileDrawer) mobileDrawer.classList.remove('active');
        if (drawerOverlay) drawerOverlay.classList.remove('active');
    }

    if (menuToggle) menuToggle.addEventListener('click', openDrawer);
    if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
    if (drawerOverlay) drawerOverlay.addEventListener('click', closeDrawer);

    if (searchToggle && searchBar) {
        searchToggle.addEventListener('click', function () {
            searchBar.classList.toggle('active');
        });
    }

    if (scrollTop) {
        scrollTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});