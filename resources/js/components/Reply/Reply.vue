<template>
    <div class="mt-3">
        <v-card dark>
            <v-card-title>

                <div class="headline">{{data.user}}</div>

                <v-card-subtitle class=""> said {{data.created_at}}</v-card-subtitle>
            </v-card-title>

            <v-divider></v-divider>
          <edit-reply
                  v-if="editing"
                  :reply="data"></edit-reply>
            <v-card-text v-else v-html="reply"></v-card-text>

            <div v-if="!editing">
            <v-divider></v-divider>
            <v-card-actions v-if="own">

                <v-btn icon @click="edit">
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn icon @click="destroy(index)">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
            </div>
        </v-card>
    </div>
</template>

<script>
    import EditReply from './EditReply'
    export default {
        data(){
            return{
                editing:false
            }
        },
        components:{EditReply},
        props:['data','index'],
        computed:{
            own(){
                return User.own(this.data.user_id)
            },
            reply(){
                    return md.parse(this.data.reply);
                }

        },created(){
          this.listen()
        },
        methods:{
            destroy(index){
                EventBus.$emit('deleteReply',index)
            },
            edit(){
                this.editing = true
            },
            listen(){
                EventBus.$on('cancelEditing',()=>{
                    this.editing =false
                })
            }
        }
    }
</script>

<style scoped>

</style>