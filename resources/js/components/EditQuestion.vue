<template>

    <v-container >

        <v-form @submit.prevent="save">

        <v-text-field
                v-model="form.title"
                label="Title"
                type = "text"
                filled
                rounded
                required
        ></v-text-field>


        <vue-simplemde v-model="form.body" preview-class="markdown-body" />
        <v-btn
                color="teal"
                type="submit"
                dark
        >
            save
        </v-btn>
        <v-btn
                color="black"
                dark
                @click="cancel"
        >
            Cancel
        </v-btn>
    </v-form>
    </v-container>

</template>

<script>
    export default {
        data(){
            return{
                form:{
                    title:null,
                    body:null
                }
            }
        },props:['data']
        ,created(){

            this.form = this.data

        },
        methods:{
            cancel(){
                EventBus.$emit('cancelEditing')
            },
            save(){
                axios.put('http://realtimeapp.test/api/question/'+this.data.slug,this.form)
                    .then(res=> this.cancel())
                    .catch(error=> console.log(error.response.data))
            }
        }

    }
</script>

<style scoped>

</style>