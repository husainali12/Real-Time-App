<template >
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-badge
                        color="pink"
                        content="6"
                        overlap
                >
                <v-btn  icon
                        v-on="on"
                >
                    <v-icon :color="color">add_alert</v-icon>{{unReadCount}}
                    </v-btn>
                </v-badge>

            </template>
            <v-list>
                <v-list-item v-for="item in  unRead"
                             :key="item.id"
                              >
                    <router-link :to="item.path" >
                    <v-list-item-title @click="readIt(item)">{{item.question}}</v-list-item-title>
                    </router-link>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list>
                <v-list-item v-for="item in read"
                             :key="item.id"
                >
                    <v-list-item-title>{{item.question}}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              read:{},
              unRead:{},
              unReadCount:0,
              sound:"http://soundbible.com/mp3/sms-alert-1-daniel_simon.mp3"
          }
        },
        created() {
            if (User.loggedIn()){
                this.getNotifications()
            }

            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.playSound()
                    this.unRead.unshift(notification);
                    this.unReadCount++ ;
                });
        },
        methods:{
            getNotifications(){
                axios.post('/api/notifications')
                    .then(res => {
                        this.read = res.data.read;
                        this.unRead = res.data.unRead;
                        this.unReadCount = res.data.unRead.length;
                    }).catch(error => Exception.handle(error))
            },
            readIt(notification){
                axios.post('/api/markAsRead',{id:notification.id})
                    .then(res=>{
                        this.unRead.splice(notification,1)
                        this.read.push(notification)
                        this.unReadCount --
                    })
            },
            playSound(){

                let alert = new Audio(this.sound)

                alert.play()
            }
        },
        computed:{
            color(){
                return this.unReadCount > 0 ? 'red' : 'red lighten-4'
            }
        }
    }
</script>

<style scoped>

</style>