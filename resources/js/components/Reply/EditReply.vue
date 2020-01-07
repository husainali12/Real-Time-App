<template>
    <div>
        <vue-simplemde  v-model="reply.reply"  />
    <v-card-actions>

        <v-btn icon @click="update">
            <v-icon color="teal">save</v-icon>
        </v-btn>
        <v-btn icon @click="cancel">
            <v-icon color="black">cancel</v-icon>
        </v-btn>
    </v-card-actions>
        </div>
</template>

<script>
    export default {
        data(){
            return{
                body:''
            }
        },props:['reply'],
        methods:{
            cancel(){
                EventBus.$emit('cancelEditing')
            },
            update(){
              axios.patch('/api/question/'+this.reply.question_slug+'/reply/'+this.reply.id , {body:this.reply.reply})
                  .then(res=>this.cancel())
            }
        }
    }
</script>

<style scoped>

</style>