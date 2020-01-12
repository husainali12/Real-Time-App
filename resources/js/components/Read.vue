<template>
    <div v-if="question">

        <editquestion
        :data="question"
        v-if="editing"
        ></editquestion>

        <showquestion
                :data="question"
                v-else
        >
        </showquestion>

        <v-container>
        <replies :question="question"></replies>

            <new-reply v-if="loggedIn" :questionSlug="question.slug"></new-reply>
            <div class="mt-4" v-else>
                <router-link to="/login">
                    Login to Reply
                </router-link>
            </div>
        </v-container>
    </div>



</template>

<script>
    import showquestion from './ShowQuestion'
    import editquestion from './EditQuestion'
    import Replies from './Reply/Replies'
    import NewReply from './Reply/NewReply'



    export default {
        data(){
            return{
                question:null,
                editing:false
            }
        },
       created() {
            this.listing()

           axios.get(`/api/question/${this.$route.params.slug}`)
               .then(res=> this.question = res.data.data)
               .catch(error=>console.log(error.response.data))
       },computed:{
            loggedIn(){
                return User.loggedIn()
            }
        },
        methods:{
            listing(){
                EventBus.$on('editing',()=>{
                    this.editing = true;
                })

                EventBus.$on('cancelEditing',()=>{
                    this.editing = false;
                })

            }
        },
        components:{showquestion,editquestion,Replies,NewReply}
    }
</script>

<style scoped>

</style>