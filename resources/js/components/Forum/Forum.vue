<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>

          <question
          v-for="question in questions"
          :key="question.path"
          :question= question
          v-if="questions"
           ></question>
                <v-sheet v-if="!questions"
                        class="px-3 pt-3 pb-3"
                >
                    <v-skeleton-loader
                            class="mx-auto"
                            type="article"
                    ></v-skeleton-loader>
                </v-sheet>
            </v-flex>
            <v-flex xs4>
            <app-sidebar></app-sidebar>
            </v-flex>
        </v-layout>
    </v-container>

</template>

<script>
    import question from '../Question'
    import AppSidebar from './AppSidebar'
    export default {
        data(){
            return{
                questions:null
            }
        },
     components:{question,AppSidebar},
        created() {
         axios.get('/api/question')
             .then(res => this.questions = res.data.data)
             .catch(error=>console.log(error.response.data))
        }
    };
</script>
