const state = {
    validationErrors: [],
    successMessage: "",
};

const mutations = {
    setValidationErrors: (state, errors) => {
        state.validationErrors = Object.values(errors).flat();
    },
    setSuccessMessage: (state, message) => {
        state.successMessage = message;
    },
};

const actions = {
    clearNotifications({ commit }) {
        commit("setValidationErrors", []);
        commit("setSuccessMessage", "");
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
};
