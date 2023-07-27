import { createStore } from "vuex";
import axios from "axios";
import router from "vue-router"; // Import the Vue Router instance
export const store = createStore({
    state: {
        players: [],
        goalkeepers: [],
        defenders: [],
        midfielders: [],
        attackers: [],
        lines: [],
        forms: [],
        playerPositionEnum: [
            "Goalkeeper",
            "Defender",
            "Midfielder",
            "Attacker",
        ],
        validationErrors: [],
        successMessage: "",
    },
    getters: {
        allPlayers: (state) => state.players,
        players: (state) => state.players,
        playerPositionEnum: (state) => state.playerPositionEnum,
        validationErrors: (state) => state.validationErrors,
        successMessage: (state) => state.successMessage,
        lines: (state) => state.lines,
        forms: (state) => state.forms,
        goalkeepers: (state) => state.goalkeepers,
        defenders: (state) => state.defenders,
        midfielders: (state) => state.midfielders,
        attackers: (state) => state.attackers,
    },
    mutations: {
        //Committing,
        setPlayers: (state, players) => {
            // Transform the position to all capital letters
            players.forEach((player) => {
                player.position = player.position.toUpperCase();
            });
            state.players = players;
        },
        setLines: (state, lines) => {
            state.lines = lines;
        },
        setForms: (state, forms) => {
            state.forms = forms;
        },
        setGoalKeepers: (state, goalkeepers) => {
            state.goalkeepers = goalkeepers;
        },
        setDefenders: (state, defenders) => {
            state.defenders = defenders;
        },
        setMidfielders: (state, midfielders) => {
            state.midfielders = midfielders;
        },
        setAttackers: (state, attackers) => {
            state.attackers = attackers;
        },
        addPlayer: (state, newPlayer) => {
            state.players.unshift(newPlayer); //Add to the front
        },
        newLineUp: (state, line) => {
            state.lines.unshift(line); //Add to the front
        },
        deletePlayer: (state, playerId) => {
            state.players = state.players.filter(
                (player) => player.id !== playerId
            );
        },
        deleteFormLineUp: (state, formId) => {
            state.forms = state.forms.filter((form) => form.id !== formId);
        },
        deleteLineUp: (state, lineId) => {
            state.lines = state.lines.filter((line) => line.id !== lineId);
        },
        setValidationErrors: (state, errors) => {
            state.validationErrors = Object.values(errors).flat();
        },
        setSSuccessMessage: (state, messages) => {
            state.successMessage = messages;
        },
    },
    actions: {
        //Dispatching
        async fetchPlayers({ commit }) {
            const response = await axios.get("/api/player");
            commit("setPlayers", response.data);
        },
        async fetchLines({ commit }) {
            const response = await axios.get("/api/lines");
            commit("setLines", response.data);
        },
        async fetchForms({ commit }) {
            const response = await axios.get("/api/formation");
            commit("setForms", response.data);
        },
        async fetchGoalKeepers({ commit }) {
            const response = await axios.get("/api/goalkeepers");
            commit("setGoalKeepers", response.data);
        },
        async fetchDefenders({ commit }) {
            const response = await axios.get("/api/defenders");
            commit("setDefenders", response.data);
        },
        async fetchMidfielder({ commit }) {
            const response = await axios.get("/api/midfielders");
            commit("setMidfielders", response.data);
        },
        async fetchAttackers({ commit }) {
            const response = await axios.get("/api/attackers");
            commit("setAttackers", response.data);
        },
        async addPlayer({ commit }, playerData) {
            try {
                const response = await axios.post("/api/player", playerData);
                console.log(response);
                commit("addPlayer", response.data);
                const successMessage = "New player has been added successfully";
                commit("setSSuccessMessage", successMessage);
            } catch (error) {
                console.log(error.response);
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
        async addLineUpForm({ commit }, data) {
            try {
                const response = await axios.post("/api/lines", data);
                console.log(response);
                commit("newLineUp", response.data);
                const successMessage =
                    "New Lineup form has been added successfully";
                commit("setSSuccessMessage", successMessage);
            } catch (error) {
                console.log(error.response);
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
        async addFormLineUp({ commit }, data) {
            try {
                const response = await axios.post("/api/formation", data);
                console.log(response);
            } catch (error) {
                console.log(error.response);
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
        async updatePlayer({ commit }, { id, data }) {
            try {
                const response = await axios.put(`/api/player/${id}`, data);
                //TODO:Re-render players
            } catch (error) {
                console.log(error.response);
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
        async updateFormLineUp({ commit }, { id, data }) {
            try {
                const response = await axios.put(`/api/lines/${id}`, data);
                console.log(response);
            } catch (error) {
                console.log(error.response);
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
        async deletePlayer({ commit }, { id, data }) {
            try {
                const response = await axios.delete(`/api/player/${id}`, data);
                commit("deletePlayer", id);
                const successMessage = "Player has been deleted successfully";
                commit("setSSuccessMessage", successMessage);
            } catch (error) {
                console.log(error.response);
                // Handle any errors, if needed
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
        async deleteLineUp({ commit }, { id, data }) {
            try {
                const response = await axios.delete(`/api/lines/${id}`, data);
                commit("deleteLineUp", id);
                const successMessage = "Player has been deleted successfully";
                commit("setSSuccessMessage", successMessage);
            } catch (error) {
                console.log(error.response);
                // Handle any errors, if needed
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
        async deleteFormLineUp({ commit }, { id, data }) {
            try {
                const response = await axios.delete(
                    `/api/formation/${id}`,
                    data
                );
                commit("deleteFormLineUp", id);
                const successMessage = "Player has been deleted successfully";
                commit("setSSuccessMessage", successMessage);
            } catch (error) {
                console.log(error.response);
                // Handle any errors, if needed
                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    commit("setValidationErrors", validationErrors);
                }
            }
        },
    },
});
