jQuery(document).ready(function($) {
    function updateLifeDisplay(element, life) {
        element.text('Life: ' + life);
    }

    function updateDamageDisplay(element, damage) {
        element.text('Damage: ' + damage);
    }

    function toggleCondition(element) {
        let status = element.find('span').text();
        status = status === 'Off' ? 'On' : 'Off';
        element.find('span').text(status);
    }

    $('.life-button').click(function() {
        let action = $(this).data('action');
        let lifeDisplay = $(this).siblings('.life-display');
        let life = parseInt(lifeDisplay.data('life'));
        life = action === 'add' ? life + 10 : life - 10;
        lifeDisplay.data('life', life);
        updateLifeDisplay(lifeDisplay, life);
    });

    $('.damage-button').click(function() {
        let action = $(this).data('action');
        let damageDisplay = $(this).siblings('.damage-display');
        let damage = parseInt(damageDisplay.data('damage'));
        damage = action === 'add' ? damage + 10 : damage - 10;
        damageDisplay.data('damage', damage);
        updateDamageDisplay(damageDisplay, damage);
    });

    $('.condition-button').click(function() {
        let conditionDisplay = $(this).siblings('.condition[data-condition="' + $(this).data('condition') + '"]');
        toggleCondition(conditionDisplay);
    });

    $('#reset-game').click(function() {
        $('.life-display').each(function() {
            $(this).data('life', 100);
            updateLifeDisplay($(this), 100);
        });
        $('.damage-display').each(function() {
            $(this).data('damage', 0);
            updateDamageDisplay($(this), 0);
        });
        $('.condition span').text('Off');
    });
});
