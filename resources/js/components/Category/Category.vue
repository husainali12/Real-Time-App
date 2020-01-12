<template>
    <v-container>
        <v-form @submit.prevent="submit">
            <v-text-field
                    v-model="form.name"
                    label="Category Name"
                    type = "text"
                    required
            ></v-text-field>
            <v-btn type="submit" color="pink" :disabled="disabled" v-if="editSlug">Update</v-btn>
            <v-btn type="submit" color="teal" :disabled="disabled" v-else>Create</v-btn>
        </v-form>

        <v-card
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
                <div v-for="(category,index) in categories"
                     :key="category.id">
                <v-list-item>

                    <v-list-item-action>
                        <v-btn icon @click="edit(category.slug,index)">
                        <v-icon  color="orange">edit</v-icon>
                        </v-btn>
                    </v-list-item-action>

                    <v-list-item-content>

                        <v-list-item-title >{{category.name}}</v-list-item-title>
                    </v-list-item-content>

                    <v-list-item-action>
                        <v-btn icon @click="destroy(category.slug,index)">
                            <v-icon  color="red">delete</v-icon>
                        </v-btn>

                    </v-list-item-action>

                </v-list-item>
                    <v-divider></v-divider>
                </div>

            </v-list>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        data(){
            return{
                form:{
                    name:null,
                    slug:null
                },
                categories:{},
                editSlug:null
            }
        },
        methods:{
            submit(){

                this.editSlug ? this.update() : this.create();


            },update(){
                axios.patch('api/category/'+this.editSlug,this.form)
                    .then(res => {
                        this.categories.unshift(res.data)
                        this.form.name = null
                    })
            },create(){
                axios.post('api/category',this.form)
                    .then(res => {
                        this.categories.unshift(res.data)
                        this.form.name = null
                    })
            },
            destroy(slug,index){
                axios.delete('api/category/'+slug)
                    .then(res => this.categories.splice(index,1))
            },
            edit(slug,index){
                this.form.name = this.categories[index].name;

                this.editSlug = slug;

                this.categories.splice(index,1);
            }
        },created(){

            if (! User.admin()){
                this.$router.push('/forum');
            }
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.data))
        },computed:{
            disabled(){
                return !(this.form.name)
            }
        }
    };
</script>
