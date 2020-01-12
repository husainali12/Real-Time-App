<template>
    <v-col>
        <v-card

                color="#385F73"
                dark
        >

            <v-card-title>

                <div>

                <div class="headline">

                    {{data.title}}

                </div>

                <v-card-subtitle>

                    {{data.user}} said {{data.created_at}}

                </v-card-subtitle>

                </div>

                <v-spacer></v-spacer>

                <v-btn color="teal">{{replyCount}} replies</v-btn>

            </v-card-title>

          <v-card-text v-html="body" ></v-card-text>
            <v-card-actions v-if="own">

                <v-btn icon dark @click="edit" >

                    <v-icon color="orange">edit</v-icon>
                </v-btn>

                <v-btn icon dark @click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>

            </v-card-actions>

        </v-card>
    </v-col>
</template>

<script>
    export default {
        data(){
          return{
              own: User.own(this.data.user_id),
              replyCount: this.data.replies_count
          }
        },
        props:['data'],
        computed:{
            body(){
                return md.parse(this.data.body);
            }
        },
        methods:{
            destroy(){
                axios.delete('/api/question/'+this.data.slug)
                    .then(res => this.$router.push('/forum'))
                    .catch(error => console.log(error.response.data))
            },
            edit(){
                EventBus.$emit('editing');

            }
        },created() {
            EventBus.$on('newReply',()=>{

                this.replyCount ++

            })
            EventBus.$on('deleteReply',()=>{

                this.replyCount --

            })
            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.replyCount ++
                });

            Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent',(e)=>{
                    this.replyCount --
                })
        }
    }
</script>

<style scoped>

</style>