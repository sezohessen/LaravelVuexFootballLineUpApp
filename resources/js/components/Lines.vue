<template>
    <div>
        <h2>Lines</h2>
        <button @click="showAddPopup" class="btn btn-success">Add</button>
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
                        <th>Defenders</th>
                        <th>Midfielders</th>
                        <th>Attackers</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="line in paginatedLines" :key="line.id">
                        <td>{{ line.id }}</td>
                        <td class="text-primary">{{ line.no_defenders }}</td>
                        <td class="text-success">{{ line.no_midfielders }}</td>
                        <td class="text-danger">{{ line.no_attackers }}</td>
                        <td>
                            <button @click="updateLine(line)" class="btn btn-primary">
                                <i class="bi bi-pencil-fill"></i> Update
                            </button>
                            <button @click="deleteLine(line)" class="btn btn-danger">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination v-if="totalPages > 1" :current-page="currentPage" :total-pages="totalPages" @change-page="changePage" />
        <line-up-popup v-if="showPopup" @close="closeAddPopup"
        :validationErrors="validationErrors" :line="line"/>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import LineUpPopup from './LineUp/LineUpPopup.vue';
import pagination from './PaginationComponent.vue';
export default {
    components: {
        pagination,
        LineUpPopup
    },
    data() {
        return {
            showPopup: false,
            currentPage: 1,
            itemsPerPage: 5,
            line: null,
        };
    },
    computed: {
        ...mapGetters(['lines','validationErrors', 'SuccessMessage']),
        lines() {
            return this.$store.state.lines;
        },
        totalPages() {
            return Math.ceil(this.lines.length / this.itemsPerPage);
        },
        paginatedLines() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.lines.slice(start, end);
        },
    },
    created() {
        this.$store.dispatch('fetchLines');
    },
    methods: {
        updateLine(line) {
            this.line = line;
            this.showPopup = true;
        },
        deleteLine(line) {
            this.$store.dispatch('deleteLineUp', {
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
    },
};
</script>
