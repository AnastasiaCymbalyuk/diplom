<template>
    <router-view/>
    <NavList v-show="$route.name!=='seances' " v-if="$route.name!=='payment' && $route.name!=='ticket'" ref="date"/>
    <MovieList v-if="$route.name!=='payment' && $route.name!=='seances' && $route.name!=='ticket'" />
</template>

<script>

import NavList from "./components/NavList.vue";
import MovieList from "./components/MovieList.vue";

    export default {
        
        components: {
            NavList,
            MovieList,
        },

        mounted() {
            console.log('Component form user')
        },

        data() {
            return {
            
            }
        },

        methods: {
            
        }
    }
</script>