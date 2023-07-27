<template>
    <div class="popup formation">
        <div class="overlay" @click="closePopup"></div>
        <div class="popup-form">
            <h3>View Players</h3>

            <!-- Goalkeeper Line -->
            <player-card :players="filteredGoalkeepers" stylish="goalkeeper"></player-card>

            <!-- Defender Line -->
            <player-card :players="filteredDefenders" stylish="defender"></player-card>

            <!-- Midfielder Line -->
            <player-card :players="filteredMidfielders" stylish="midfielder"></player-card>

            <!-- Attacker Line -->
            <player-card :players="filteredAttackers" stylish="attacker"></player-card>

            <button @click="closePopup" class="d-block">Close</button>
        </div>
    </div>
</template>

<script>
import PlayerCard from './PlayerCard.vue';
export default {
    components:{
        PlayerCard
    },
    props: {
        lineForm: {
            type: String,
            required: true,
        },
        players: {
            type: Array,
            required: true,
        },
    },
    computed: {
        filteredGoalkeepers() {
            return this.filteredPlayers.filter(
                (player) => player.position === 'Goalkeeper'
            );
        },
        filteredDefenders() {
            return this.filteredPlayers.filter(
                (player) => player.position === 'Defender'
            );
        },
        filteredMidfielders() {
            return this.filteredPlayers.filter(
                (player) => player.position === 'Midfielder'
            );
        },
        filteredAttackers() {
            return this.filteredPlayers.filter(
                (player) => player.position === 'Attacker'
            );
        },
        filteredPlayers() {
            return this.players;
        },
    },
    methods: {
        closePopup() {
            this.$emit("close");
        },
    },
};
</script>
