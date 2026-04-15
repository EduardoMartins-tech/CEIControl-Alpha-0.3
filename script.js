let currentSlide = 0;
const textSlides = document.querySelectorAll('.carousel-item');
const imageSlides = document.querySelectorAll('.c-img');

function showSlide(index) {
    // Resetar todos
    textSlides.forEach(s => s.classList.remove('active'));
    imageSlides.forEach(img => img.classList.remove('active'));
    
    // Ativar o atual
    textSlides[index].classList.add('active');
    imageSlides[index].classList.add('active');
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % textSlides.length;
    showSlide(currentSlide);
}

// Trocar a cada 4 segundos para ficar dinâmico
setInterval(nextSlide, 4000);

function toggleDarkMode() {
    const isDark = document.body.classList.toggle('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    updateInterface(isDark);
}

function updateInterface(isDark) {
    const checkbox = document.getElementById('checkbox');
    if (checkbox) {
        checkbox.checked = isDark;
    }
}

// Executa automaticamente ao carregar qualquer página
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
        updateInterface(true);
    }
});