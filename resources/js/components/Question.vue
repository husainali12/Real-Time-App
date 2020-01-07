<template>
    <v-col>
    <v-card
            shaped
            color="#385F73"
            dark
    >
        <v-card-title class="headline" >
            <router-link :to="question.path" >
            {{question.title}}
            </router-link>
        </v-card-title>

        <v-card-subtitle class="">{{question.created_at}}</v-card-subtitle>

        <v-card-text v-html="body">

        </v-card-text>


    </v-card>
    </v-col>
</template>

<script>
    export default {
  props:['question'],
        computed:{
            body(){
                return md.parse(this.question.body);
            }
        }
    }
</script>

<style scoped>

</style>