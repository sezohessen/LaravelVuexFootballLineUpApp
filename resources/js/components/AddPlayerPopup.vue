<template>
    <div class="popup">
        <div class="overlay" @click="closePopup"></div>
        <div class="popup-form">
            <h3>{{ player ? 'Update Player' : 'Add New Player'  }}</h3>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" v-model="formData.name" required />
                </div>
                <div class="form-group">
                    <label for="t_shirt">T-Shirt Number:</label>
                    <input type="number" id="t_shirt" v-model="formData.t_shirt" required />
                </div>
                <div class="form-group">
                    <label for="position">Position:</label>
                    <select id="position" v-model="formData.position" required>
                        <option disabled value="">Select Position</option>
                        <option v-for="position in playerPositions" :key="position" :value="position">{{ position }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">{{ player ? 'Update Player' : 'Add Player' }}</button>
                    <button @click="closePopup" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        playerPositions: {
            type: Array,
            required: true,
        },
        player: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            formData: {
                name: this.player ? this.player.name : '',
                t_shirt: this.player ? this.player.t_shirt_num : '',
                position: this.player ? this.player.position : '',
            },
        };
    },
    methods: {
        submitForm() {
            if (this.player) {
                this.updatePlayer();
            } else {
                this.addPlayer();
            }
        },
        closePopup() {
            this.$emit('close');
        },
        addPlayer() {
            // Dispatch the Vuex action to add the player
            this.$store.dispatch('addPlayer', this.formData);
            this.closePopup();
        },
        updatePlayer() {
            // Dispatch the Vuex action to update the player
            this.$store.dispatch('updatePlayer', {
                id: this.player.id,
                data: this.formData,
            });
            this.closePopup();
        },
    }
};
</script>
