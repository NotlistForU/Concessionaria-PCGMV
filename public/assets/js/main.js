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
    const iconSun = '<path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>';
    const iconMoon = '<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.279 7.306 7.279.13 0 .258-.005.386-.015a.768.768 0 0 1 .904.904 8.5 8.5 0 1 1-7.798-12.484.768.768 0 0 1 .002 0z"/>';

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
