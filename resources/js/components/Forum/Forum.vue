<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>

                <div v-if="questions">

          <question
          v-for="question in questions"
          :key="question.path"
          :question= question

           ></question>

                    <div class="text-center">
                        <v-pagination
                                v-model="pagination.current"
                                :length="pagination.total"
                                prev-icon="menu-left"
                                next-icon="menu-right"
                                @input="paginate"
                                circle
                        ></v-pagination>
                    </div>
                </div>
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
                questions:null,
                pagination:{
                    current:1,
                    total:0

                }
            }
        },
     components:{question,AppSidebar},
        created() {
         axios.get('/api/question')
             .then(res => {
                 this.questions = res.data.data
                 this.pagination.total = res.data.meta.last_page
                 this.pagination.current = res.data.meta.current_page
             })
             .catch(error=>console.log(error.response.data))
        },
        methods:{
            paginate(){
                axios.get('/api/question?page='+this.pagination.current)
                    .then(res => {
                        this.questions = res.data.data
                        this.pagination.total = res.data.meta.last_page
                        this.pagination.current = res.data.meta.current_page
                    })
                    .catch(error=>console.log(error.response.data))
            }
        }
    };
</script>
