<template>
    <div>
        <h2>Players</h2>
        <button @click="showAddPlayerPopup" class="btn btn-success">Add</button>
        <!-- Show validation errors -->
        <div v-if="validationErrors.length" class="error-container">
            <ul>
                <li v-for="error in validationErrors" :key="error">{{ error }}</li>
            </ul>
        </div>
        <div v-if="SuccessMessage" class="success-container">
            <span>{{ SuccessMessage }}</span>
        </div>
        <div class="players-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>T-Shirt Number</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="player in paginatedPlayers" :key="player.id">
                        <td>{{ player.id }}</td>
                        <td>{{ player.name }}</td>
                        <td>{{ player.t_shirt_num }}</td>
                        <td :class="getPositionClass(player.position)">{{ player.position }}</td>
                        <td>
                            <button @click="updatePlayer(player)" class="btn btn-primary">
                                <i class="bi bi-pencil-fill"></i> Update
                            </button>
                            <button @click="deletePlayer(player)" class="btn btn-danger">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination v-if="totalPages > 1" :current-page="currentPage" :total-pages="totalPages" @change-page="changePage" />
        <add-player-popup v-if="showPopup" :playerPositions="playerPositions" @close="closeAddPlayerPopup"
            :validationErrors="validationErrors" :player="player" />
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import AddPlayerPopup from './AddPlayerPopup.vue';
import pagination from './PaginationComponent.vue';
export default {
    components: {
        AddPlayerPopup,
        pagination
    },
    data() {
        return {
            showPopup: false,
            currentPage: 1,
            itemsPerPage: 10,
            player: null
        };
    },
    computed: {
        ...mapGetters(['players', 'allPlayers', 'playerPositionEnum', 'validationErrors', 'SuccessMessage']),
        players() {
            return this.allPlayers;
        },
        totalPages() {
            return Math.ceil(this.players.length / this.itemsPerPage);
        },
        paginatedPlayers() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.players.slice(start, end);
        },
        playerPositions() {
            return this.playerPositionEnum;
        },
    },
    created() {
        this.$store.dispatch('fetchPlayers');
    },
    methods: {
        updatePlayer(player) {

            this.player = player;
            this.showPopup = true;
        },
        deletePlayer(player) {
            this.$store.dispatch('deletePlayer', {
                id: player.id
            });
        },
        getPositionClass(position) {
            // Return the appropriate CSS class based on the player's position
            switch (position.toLowerCase()) {
                case 'goalkeeper':
                    return 'position-goalkeeper';
                case 'midfielder':
                    return 'position-midfielder';
                case 'attacker':
                    return 'position-attacker';
                case 'defender':
                    return 'position-defender';
                default:
                    return '';
            }
        },
        showAddPlayerPopup() {
            this.player = null;
            this.showPopup = true;
        },
        closeAddPlayerPopup() {
            this.showPopup = false;
        },
        changePage(page) {
            this.currentPage = page;
        },
    },
};
</script>
