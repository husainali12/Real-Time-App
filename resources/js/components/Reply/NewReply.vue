<template>
    <div class="mt-4">
    <vue-simplemde v-model="body" preview-class="markdown-body" />
    <v-btn color="teal" @click="submit">
        Reply
    </v-btn>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              body:null
          }
        },
        props:['questionSlug'],
        methods:{
            submit(){
                axios.post('http://realtimeapp.test/api/question/'+this.questionSlug+'/reply',{body:this.body})
                    .then(res => {
                        this.body = '';
                        EventBus.$emit('newReply',res.data.reply);
                    })
            }
        }
    }
</script>

<style scoped>

</style>