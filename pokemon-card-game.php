<?php
/*
Plugin Name: Pokémon Card Game Tracker
Description: A simple tracker for Pokémon card game life points, damage, and status conditions.
Version: 1.1
Author: Void, Corp
*/

function pokemon_card_game_enqueue_scripts() {
    wp_enqueue_style('pokemon-card-game-style', plugins_url('pokemon-card-game.css', __FILE__));
    wp_enqueue_script('pokemon-card-game-script', plugins_url('pokemon-card-game.js', __FILE__), array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'pokemon_card_game_enqueue_scripts');

function pokemon_card_game_shortcode($atts) {
    $atts = shortcode_atts(array(
        'players' => '2',  // Default to 2 players
    ), $atts, 'pokemon_card_game');
    $players = intval($atts['players']);
    ob_start();
    ?>
    <div id="pokemon-card-game">
        <h1 style="color: #ffcb05;">Pokémon Card Game Tracker</h1>
        <div class="players">
            <?php for ($i = 1; $i <= $players; $i++) : ?>
            <div class="player" data-player="<?php echo $i; ?>">
                <h2>Player <?php echo $i; ?></h2>
                <?php for ($j = 1; $j <= 6; $j++) : ?>
                <div class="pokemon" data-pokemon="<?php echo $j; ?>">
                    <h3>Pokémon <?php echo $j; ?></h3>
                    <div class="life-counter">
                        <div class="life-display" data-life="100">Life: 100</div>
                        <button class="life-button" data-action="add">+1 Life</button>
                        <button class="life-button" data-action="subtract">-1 Life</button>
                    </div>
                    <div class="damage-counter">
                        <div class="damage-display" data-damage="0">Damage: 0</div>
                        <button class="damage-button" data-action="add">+10 Damage</button>
                        <button class="damage-button" data-action="subtract">-10 Damage</button>
                    </div>
                    <div class="status-conditions">
                        <div class="condition" data-condition="burned">Burned: <span>Off</span></div>
                        <button class="condition-button" data-condition="burned">Toggle Burned</button>
                        <div class="condition" data-condition="paralyzed">Paralyzed: <span>Off</span></div>
                        <button class="condition-button" data-condition="paralyzed">Toggle Paralyzed</button>
                        <div class="condition" data-condition="asleep">Asleep: <span>Off</span></div>
                        <button class="condition-button" data-condition="asleep">Toggle Asleep</button>
                        <div class="condition" data-condition="poisoned">Poisoned: <span>Off</span></div>
                        <button class="condition-button" data-condition="poisoned">Toggle Poisoned</button>
                        <div class="condition" data-condition="confused">Confused: <span>Off</span></div>
                        <button class="condition-button" data-condition="confused">Toggle Confused</button>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <?php endfor; ?>
        </div>
        <button id="reset-game">Reset Game</button>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('pokemon_card_game', 'pokemon_card_game_shortcode');
?>
