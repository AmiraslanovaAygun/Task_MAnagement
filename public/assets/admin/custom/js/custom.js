// Dark/Light mode toggle
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const themeIcon = document.getElementById('themeIcon');
    const themeButton = document.querySelector('.light-mode-button');

    // İlk dəfə səhifə açıldıqda dark mode-u aktiv et
    if (!body.classList.contains('dark-mode')) {
        body.classList.add('dark-mode'); // Başlanğıcda dark mode
        themeIcon.classList.add('fa-toggle-off'); // iconu fa-toggle-off et
        themeIcon.classList.remove('fa-toggle-on'); // iconu fa-toggle-on sil
    }

    // Butona basıldıqda dark mode və ya light mode arasında keçid et
    themeButton.addEventListener('click', function () {
        // Dark mode yoxlanılır
        if (body.classList.contains('dark-mode')) {
            body.classList.remove('dark-mode');  // Dark mode-u sil
            themeIcon.classList.remove('fa-toggle-off'); // fa-toggle-off iconunu sil
            themeIcon.classList.add('fa-toggle-on');     // fa-toggle-on iconunu əlavə et
            themeButton.classList.remove('dark-mode-button');  // Dark mode butonunu sil
            themeButton.classList.add('light-mode-button');    // Light mode butonunu əlavə et
        } else {
            body.classList.add('dark-mode');      // Dark mode əlavə et
            themeIcon.classList.remove('fa-toggle-on'); // fa-toggle-on iconunu sil
            themeIcon.classList.add('fa-toggle-off');   // fa-toggle-off iconunu əlavə et
            themeButton.classList.remove('light-mode-button'); // Light mode butonunu sil
            themeButton.classList.add('dark-mode-button'); // Dark mode butonunu əlavə et
        }
    });
});
