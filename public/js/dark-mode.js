document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme === 'dark') {
        body.classList.add('dark-mode');
    }

    const themeToggle = document.getElementById('theme-toggle');
    if (!themeToggle) return;

    const icon = themeToggle.querySelector('i');
    const text = themeToggle.querySelector('span');

    if (currentTheme === 'dark') {
        updateToggleButton(true);
    }

    themeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        
        const isDark = body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        updateToggleButton(isDark);
    });

    function updateToggleButton(isDark) {
        if (!icon || !text) return;

        if (isDark) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            text.textContent = 'Light Mode';
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            text.textContent = 'Dark Mode';
        }
    }
});


