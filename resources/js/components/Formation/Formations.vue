<template>
    <div>
        <h2>Formation Line-up</h2>
        <button @click="AddNewFormLineUp" class="btn btn-success">Add</button>
        <!-- Show validation errors -->
        <div v-if="validationErrors.length" class="error-container">
            <ul>
                <li v-for="error in validationErrors" :key="error">{{ error }}</li>
            </ul>
        </div>
        <div v-if="successMessage" class="success-container">
            <span>{{ successMessage }}</span>
        </div>
        <div class="players-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Line</th>
                        <th>View Players</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="form in paginatedForms" :key="form.id">
                        <td>{{ form.id }}</td>
                        <td>
                            <div>
                                <span class="text-primary">
                                    {{ form.line.no_defenders }}
                                </span>
                                -
                                <span class="text-success">
                                    {{ form.line.no_midfielders }}
                                </span>
                                -
                                <span class="text-danger">
                                    {{ form.line.no_attackers }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <button @click="viewPlayers(form)" class="btn btn-info">
                                <i class="fa fa-view"></i> View Players
                            </button>
                        </td>
                        <td>
                            <button @click="deleteForm(form)" class="btn btn-danger">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination v-if="totalPages > 1" :current-page="currentPage" :total-pages="totalPages" @change-page="changePage" />
        <ViewPlayersPopup v-if="showViewPlayersPopup" :lineForm="selectedLineForm" :players="players"
            @close="closeViewPlayersPopup" />
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import pagination from '../PaginationComponent.vue';
import ViewPlayersPopup from "./ViewPlayersPopup.vue";
export default {
    components: {
        pagination,
        ViewPlayersPopup
    },
    data() {
        return {
            showPopup: false,
            currentPage: 1,
            itemsPerPage: 5,
            line: null,
            showViewPlayersPopup: false,
            selectedLineForm: "",
            players: []
        };
    },
    computed: {
        ...mapGetters(['forms', 'validationErrors', 'successMessage']),
        forms() {
            return this.$store.state.forms;
        },
        totalPages() {
            return Math.ceil(this.forms.length / this.itemsPerPage);
        },
        paginatedForms() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.forms.slice(start, end);
        },
    },
    created() {
        console.log(this.$store.state.forms);
        this.$store.dispatch('fetchForms');
    },
    methods: {
        updateForm(line) {
            this.line = line;
            this.showPopup = true;
        },
        deleteForm(line) {
            this.$store.dispatch('deleteFormLineUp', {
                id: line.id
            });
        },
        showAddPopup() {
            this.line = null;
            this.showPopup = true;
        },
        closeAddPopup() {
            this.showPopup = false;
        },
        changePage(page) {
            this.currentPage = page;
        },
        closeViewPlayersPopup() {
            this.showViewPlayersPopup = false;
        },
        viewPlayers(form) {
            this.selectedLineForm = form.line;
            this.players = form.players;
            this.showViewPlayersPopup = true;
        },
        AddNewFormLineUp(){
            this.$router.push("/formations/create");
        }
    },
};
</script>
