<template>
    <div class="popup">
        <div class="overlay" @click="closePopup"></div>
        <div class="popup-form">
            <h3>{{ line ? 'Update Line' : 'Add New Line' }}</h3>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="defenders">No Defenders:</label>
                    <input type="number" id="defenders" v-model="formData.no_defenders" required />
                </div>
                <div class="form-group">
                    <label for="midfielders">No Midfielders:</label>
                    <input type="number" id="midfielders" v-model="formData.no_midfielders" required />
                </div>
                <div class="form-group">
                    <label for="attackers">No Attackers:</label>
                    <input type="number" id="attackers" v-model="formData.no_attackers" required />
                </div>

                <div class="form-group">
                    <button type="submit">{{ line ? 'Update Line' : 'Add Line' }}</button>
                    <button @click="closePopup" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: ['line'],
    data() {
        return {
            formData: {
                no_defenders: this.line ? this.line.no_defenders : '',
                no_midfielders: this.line ? this.line.no_midfielders : '',
                no_attackers: this.line ? this.line.no_attackers : '',
            },
        };
    },
    methods: {
        submitForm() {
            if (this.line) {
                this.updateForm();
            } else {
                this.addForm();
            }
        },
        closePopup() {
            this.$emit('close');
        },
        addForm() {

            this.$store.dispatch('addLineUpForm', this.formData);
            this.closePopup();
        },
        updateForm() {
            // Dispatch the Vuex action to update the player
            this.$store.dispatch('updateFormLineUp', {
                id: this.line.id,
                data: this.formData,
            });
            this.closePopup();
        },
    }
};
</script>
