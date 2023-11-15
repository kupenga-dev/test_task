$(document).ready(function() {
    function rotateButtons() {
        let container = $(this).parent();
        let firstButton = container.children('button:first');
        container.append(firstButton);
    }
    $('#buttonContainer').on('click', 'button', rotateButtons);
});