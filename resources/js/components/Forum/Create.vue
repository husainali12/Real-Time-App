<template>
    <v-form  @submit.prevent ="create">
        <v-container>

            <v-text-field
                    v-model="form.title"
                    label="Title"
                    type = "text"
                    filled
                    rounded
                    required
            ></v-text-field>

            <v-autocomplete
                    label="Select Category"
                    :items="categories"
                    item-text="name"
                    item-value="id"
                    v-model="form.category_id"
                    filled
                    rounded
                    required
            ></v-autocomplete>

            <vue-simplemde v-model="form.body" preview-class="markdown-body" />
            <v-btn
                    color="green"
                    type="submit"
                    :disabled="disabled"
            >
                Create
            </v-btn>

        </v-container>
    </v-form>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title: null,
                    category_id: null,
                    body: null
                },
                categories: [],
                errors: {}
            }
        }, created() {
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.data))
        },
        methods: {
            create() {
                axios.post('/api/question', this.form)
                    .then(res => this.$router.push(res.data.path))
                    .catch(error => this.errors = error.response.data.error)
            }
        },
        computed:{
            disabled(){
                return !(this.form.title && this.form.body && this.form.category_id)
            }
        }
    }
</script>

<style scoped>

</style>