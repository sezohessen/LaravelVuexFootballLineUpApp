import axios from "axios";

const state = {
    players: [],
    goalkeepers: [],
    defenders: [],
    midfielders: [],
    attackers: [],
    playerPositionEnum: ["Goalkeeper", "Defender", "Midfielder", "Attacker"],
    validationErrors: [],
    successMessage: "",
};

const getters = {
    allPlayers: (state) => state.players,
    playerPositionEnum: (state) => state.playerPositionEnum,
    validationErrors: (state) => state.validationErrors,
    successMessage: (state) => state.successMessage,
    goalkeepers: (state) => state.goalkeepers,
    defenders: (state) => state.defenders,
    midfielders: (state) => state.midfielders,
    attackers: (state) => state.attackers,
};

const mutations = {
    setPlayers: (state, players) => {
        // Transform the position to all capital letters
        players.forEach((player) => {
            player.position = player.position.toUpperCase();
        });
        state.players = players;
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
        state.players.unshift(newPlayer); // Add to the front
    },
    deletePlayer: (state, playerId) => {
        state.players = state.players.filter(
            (player) => player.id !== playerId
        );
    },
    setValidationErrors: (state, errors) => {
        state.validationErrors = Object.values(errors).flat();
    },
    setSuccessMessage: (state, message) => {
        state.successMessage = message;
    },
};

const actions = {
    async fetchPlayers({ commit }) {
        const response = await axios.get("/api/player");
        commit("setPlayers", response.data);
    },
    // Other actions related to players...
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
