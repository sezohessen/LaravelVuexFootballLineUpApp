import axios from "axios";

const state = {
    forms: [],
};

const getters = {
    allForms: (state) => state.forms,
};

const mutations = {
    setForms: (state, forms) => {
        state.forms = forms;
    },
    deleteFormLineUp: (state, formId) => {
        state.forms = state.forms.filter((form) => form.id !== formId);
    },
};

const actions = {
    async fetchForms({ commit }) {
        const response = await axios.get("/api/formation");
        commit("setForms", response.data);
    },
    async addFormLineUp({ commit }, data) {
        try {
            const response = await axios.post("/api/formation", data);
            console.log(response);
            // If needed, you can perform any additional actions or mutations here
        } catch (error) {
            console.log(error.response);
            if (error.response && error.response.status === 422) {
                const validationErrors = error.response.data.errors;
                commit("setValidationErrors", validationErrors, { root: true });
            }
        }
    },
    async deleteFormLineUp({ commit }, { id }) {
        try {
            await axios.delete(`/api/formation/${id}`);
            commit("deleteFormLineUp", id);
            const successMessage = "Form lineup has been deleted successfully";
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
