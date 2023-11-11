<template>

    <section class="movie" v-for="movie in movies" :key="movie.id" :id="movie.id" v-show="$route.name!=='seances'">
      <div class="movie__info">
        <div class="movie__poster">
          <img class="movie__poster-image" alt="Звёздные войны постер" src="i/users/index/poster1.jpg">
        </div>
        <div class="movie__description">
          <h2 class="movie__title">{{ movie.name }}</h2>
          <p class="movie__synopsis">Две сотни лет назад малороссийские хутора разоряла шайка нехристей-ляхов во главе с могущественным колдуном.</p>
          <p class="movie__data">
            <span class="movie__data-duration">130 минут</span>
            <span class="movie__data-origin">США</span>
          </p>
        </div>
      </div>  
      
      <div class="movie-seances__hall" v-for="hall in halls.filter(el => sessions.filter(i => i.movie_id === movie.id).find(i => i.hall_id === el.id ))">
        <h3 class="movie-seances__hall-title">{{ hall.name }}</h3>
        <ul class="movie-seances__list">
          <li class="movie-seances__time-block" v-for="session in sessions.filter(i => i.movie_id === movie.id).filter(i => i.hall_id === hall.id)">
            <router-link :to="{ name: 'seances',  path: '/payment',
              query: {
                movieName: movie.name,
                hallName: hall.name,
                hallId: hall.id,
                hallRow: hall.row,
                hallPlace: hall.place,
                hallPrice: hall.price,
                hallVipPrice: hall.vipPrice,
                sessionId: session.id,
                sessionTime: session.time 
              }
              }" class="movie-seances__time">{{ session.time }}
            </router-link>
          </li>
        </ul>
      </div> 
    </section>
 
</template>

<script>

import Seances from "./Seances.vue";

export default {

    components: {
      Seances,
    },

    name: "MovieList",
    mounted() {
      this.getListHall();
      console.log('Component form movie');
    },

    data() {
        return {
          movies: null,
          halls: null,
          sessions: null,
        }
    },

    methods: {
      getListMovie() {
        axios.get('/api/movie')
        .then(data => {
          let arr = [];
          data.data.forEach(el => {
            if(this.sessions.find(i => i.movie_id === el.id)) {
              arr.push(el);
            } 
          });
          this.movies = arr;
        });
      },

      getListSession() {
        axios.get('/api/session')
        .then(data => {
          let arr = [];
          this.halls.forEach(i => {
            data.data.forEach(el => {
              if(i.id === el.hall_id) {
                arr.push(el);
              }
            });
          });
          this.sessions = arr;
          this.getListMovie();
        });
      },

      getListHall() {
        axios.get('/api/hall')
        .then(data => {
          let arr = [];
          data.data.forEach(i => {
            if(i.isActive === 1) {
              arr.push(i);
            }
          });
          this.halls = arr;
          this.getListSession();
        });
      },
    }
}
</script>