<template>
    <v-card
            max-width="500"
            class="mx-auto mt-3"
    >
        <v-toolbar
                color="indigo"
                dark
                dense
        >

            <v-toolbar-title>Category</v-toolbar-title>

        </v-toolbar>
        <v-list rounded>
            <v-list-item
            v-for="category in categories"
            :key="category.id"
            >

                <v-list-item-content>

                    <v-list-item-title v-text="category.name"></v-list-item-title>
                </v-list-item-content>

            </v-list-item>

        </v-list>
    </v-card>
</template>

<script>
    export default {
        data(){
          return{
              categories:{}
          }
        },
       created(){
           axios.get('/api/category')
               .then(res => this.categories = res.data.data)
               .catch(error => console.log(error.response.data))
       }
    }
</script>

<style scoped>

</style>