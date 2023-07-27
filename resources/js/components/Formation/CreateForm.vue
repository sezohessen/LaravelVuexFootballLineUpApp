<template>
    <div class="formation-form">
        <h2>Create Formation</h2>

        <!-- Select box to choose from a list of lines -->
        <label for="position">Line:</label>
        <select v-model="selectedLine" @change="generatePlayerInputs" required>
            <option disabled value="">Select Line form</option>
            <option v-for="line in lines" :key="line.id" :value="line">
                {{ line.no_defenders }} - {{ line.no_midfielders }} - {{ line.no_attackers }}
            </option>
        </select>

        <!-- Generate player inputs based on the selected line -->
        <div class="player-inputs" v-if="selectedLine">
            <!-- Goalkeeper -->
            <div class="player-input">
                <label for="goalkeeper">Goalkeeper:</label>
                <select v-model="selectedPlayers.goalkeeper" required>
                    <option disabled value="">Select Player</option>
                    <option v-for="player in goalkeepers" :key="player.id" :value="player">
                        {{ player.name }}
                    </option>
                </select>
            </div>

            <!-- Defenders -->
            <div v-for="index in selectedLine.no_defenders" :key="'defender' + index" class="player-input">
                <label :for="'defender' + index">Defender {{ index }}:</label>
                <select :id="'defender' + index" v-model="selectedPlayers['defender' + index]" required>
                    <option disabled value="">Select Player</option>
                    <option v-for="player in defenders" :key="player.id" :value="player">
                        {{ player.name }}
                    </option>
                </select>
            </div>

            <!-- Midfielders -->
            <div v-for="index in selectedLine.no_midfielders" :key="'midfielder' + index" class="player-input">
                <label :for="'midfielder' + index">Midfielder {{ index }}:</label>
                <select :id="'midfielder' + index" v-model="selectedPlayers['midfielder' + index]" required>
                    <option disabled value="">Select Player</option>
                    <option v-for="player in midfielders" :key="player.id" :value="player">
                        {{ player.name }}
                    </option>
                </select>
            </div>

            <!-- Attackers -->
            <div v-for="index in selectedLine.no_attackers" :key="'attacker' + index" class="player-input">
                <label :for="'attacker' + index">Attacker {{ index }}:</label>
                <select :id="'attacker' + index" v-model="selectedPlayers['attacker' + index]" required>
                    <option disabled value="">Select Player</option>
                    <option v-for="player in attackers" :key="player.id" :value="player">
                        {{ player.name }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Submit button -->
        <button @click="submitFormation">Submit</button>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            selectedLine: null, // Selected line from the dropdown
            selectedPlayers: {}, // Object to store the selected players for each position
        };
    },
    computed: {
        ...mapGetters(["lines", "players",'goalkeepers','defenders','midfielders','attackers']),
    },
    created() {
        this.$store.dispatch("fetchLines");
        /* this.$store.dispatch("fetchPlayers"); */
        this.$store.dispatch("fetchGoalKeepers");
        this.$store.dispatch("fetchDefenders");
        this.$store.dispatch("fetchMidfielder");
        this.$store.dispatch("fetchAttackers");
    },
    methods: {
        // Generate player inputs based on the selected line
        generatePlayerInputs() {
            if (this.selectedLine) {
                this.selectedPlayers = {}; // Clear existing selections
                this.selectedPlayers.goalkeeper = null;
                for (let i = 1; i <= this.selectedLine.no_defenders; i++) {
                    this.selectedPlayers["defender" + i] = null;
                }
                for (let i = 1; i <= this.selectedLine.no_midfielders; i++) {
                    this.selectedPlayers["midfielder" + i] = null;
                }
                for (let i = 1; i <= this.selectedLine.no_attackers; i++) {
                    this.selectedPlayers["attacker" + i] = null;
                }
            }
        },
        // Submit the formation form (implement the logic to send the data to the server)
        submitFormation() {
            const formationData = {
                selectedLine: this.selectedLine,
                selectedPlayers: this.selectedPlayers
            };
            this.$store.dispatch('addFormLineUp', formationData);
            this.$router.push("/formations");
        },
    },
};
</script>

<style>
/* Add custom styles here */
.formation-form {
    font-family: Arial, sans-serif;
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.form-title {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.select-box {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.line-container {
    margin-bottom: 20px;
}

.position-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

.player-card {
    cursor: pointer;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-align: center;
    transition: background-color 0.2s ease-in-out;
}

.player-card.selected {
    background-color: #007bff;
    color: #fff;
}

.submit-button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.submit-button:hover {
    background-color: #0056b3;
}

/* Add custom styles for the form inputs */
.player-inputs {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    margin-top: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

select option[disabled] {
    color: #999;
}

.player-input {
    margin-bottom: 20px;
}
</style>
