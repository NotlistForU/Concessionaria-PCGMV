/**
 * main.js
 * Arquivo central de scripts para controle de interações do frontend, 
 * como o gerenciamento do modo claro/escuro.
 */

// Script para inicialização IMEDIATA do tema (previne "flashes" de tela branca)
// Esta IIFE será executada assim que o arquivo carregar
(function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
    }
})();

// Aguarda o DOM estar completamente carregado para adicionar os Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    
    // Gerenciamento do Tema (Dark/Light Mode)
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const htmlElement = document.documentElement;

    // Ícones em SVG
    const iconSun = '<img src="assets/img/Sun.png" style="width: 24px; height: 24px;  alt="Sol" </img>';
    const iconMoon = '<img src="assets/img/Moon.png" style="width: 24px; height: 24px;  alt="Lua" </img>';
    
    console.log(iconMoon);
    
    const updateIcon = () => {
        if (!themeIcon) return; // Segurança caso o elemento não exista na página (ex: página erro)
        const isDark = htmlElement.getAttribute('data-bs-theme') === 'dark';
        themeIcon.innerHTML = isDark ? iconSun : iconMoon;
    };

    updateIcon(); // Define o ícone inicial

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const isDark = htmlElement.getAttribute('data-bs-theme') === 'dark';
            const newTheme = isDark ? 'light' : 'dark';
            
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon();
        });
    }

});
