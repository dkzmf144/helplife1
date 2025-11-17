// Exemplo simples de como adicionar interatividade
document.addEventListener('DOMContentLoaded', () => {
    // Altera a cor do botão "Adicionar ao Carrinho" ao passar o mouse
    const addButtons = document.querySelectorAll('.btn-add');
    
    addButtons.forEach(button => {
        button.addEventListener('mouseover', () => {
            button.style.backgroundColor = '#0056b3';
        });

        button.addEventListener('mouseout', () => {
            button.style.backgroundColor = '#007bff';
        });
    });
});