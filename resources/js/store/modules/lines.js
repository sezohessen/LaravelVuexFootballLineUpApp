import axios from "axios";

const state = {
    lines: [],
};

const getters = {
    allLines: (state) => state.lines,
};

const mutations = {
    setLines: (state, lines) => {
        state.lines = lines;
    },
    newLineUp: (state, line) => {
        state.lines.unshift(line); // Add to the front
    },
    deleteLineUp: (state, lineId) => {
        state.lines = state.lines.filter((line) => line.id !== lineId);
    },
};

const actions = {
    async fetchLines({ commit }) {
        const response = await axios.get("/api/lines");
        commit("setLines", response.data);
    },
    async addLineUpForm({ commit }, data) {
        try {
            const response = await axios.post("/api/lines", data);
            commit("newLineUp", response.data);
            const successMessage =
                "New Lineup form has been added successfully";
            commit("setSuccessMessage", successMessage, { root: true });
        } catch (error) {
            console.log(error.response);
            if (error.response && error.response.status === 422) {
                const validationErrors = error.response.data.errors;
                commit("setValidationErrors", validationErrors, { root: true });
            }
        }
    },
    async deleteLineUp({ commit }, { id }) {
        try {
            await axios.delete(`/api/lines/${id}`);
            commit("deleteLineUp", id);
            const successMessage = "Lineup has been deleted successfully";
            commit("setSuccessMessage", successMessage, { root: true });
        } catch (error) {
            console.log(error.response);
            if (error.response && error.response.status === 422) {
                const validationErrors = error.response.data.errors;
                commit("setValidationErrors", validationErrors, { root: true });
            }
        }
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
