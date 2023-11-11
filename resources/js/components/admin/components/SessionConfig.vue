<template>
    
    <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">
            <button class="conf-step__button conf-step__button-accent" @click.prevent="openMovie">Добавить фильм</button>
        </p>
        <div class="popup popup_movie">
            <div class="popup__container">
                <div class="popup__content">
                    <div class="popup__header">
                        <h2 class="popup__title">
                            Добавление фильма
                            <a class="popup__dismiss" href="#"><img src="/i/admin/close.png" alt="Закрыть" @click="closeMovie"></a>
                        </h2>
                    </div>
                    <div class="popup__wrapper">
                        <form action="{{ route('movie.store') }}" method="post" accept-charset="utf-8">
                            <label class="conf-step__label conf-step__label-fullsize" for="name">
                                Название фильма
                                <input class="conf-step__input" type="text" placeholder="Например, &laquo;Гражданин Кейн&raquo;" v-model="name" name="name" required>
                            </label>
                            <div class="conf-step__buttons text-center">
                                <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent" @click.prevent="addMovie">
                                <button class="conf-step__button conf-step__button-regular" type="button" @click="closeMovie">Отменить</button>            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="conf-step__movies" >
            <div class="conf-step__movie draggable" v-for="movie in movies" :key="movie.id" :id="movie.id" @click.prevent="itemDelete(movie.id)" draggable="true" @dragstart.stop="dragStart($event, movie.id, movie.name)">
                <img class="conf-step__movie-poster" alt="poster" src="/i/admin/poster.png" draggable="false">
                <h3 class="conf-step__movie-title" draggable="false">{{ movie.name }}</h3>
                <p class="conf-step__movie-duration" draggable="false">130 минут</p>
            </div>        
        </div>
        <SessionList ref="session"/> 
        
    </div>
 
</template>

<script>
import SessionList from "./SessionList.vue";
    
export default {
    components: {
       SessionList,
    },
    name: "SessionConfig",
    mounted() {
        this.getListMovie();
        console.log('Component form session-config.');
    },

    data() {
        return {
            name: null,
            movies: null,
        }
    },

    methods: {
        dragStart(e, id, name) {
            e.dataTransfer.dropEffect = 'move';
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('id', id);
            e.dataTransfer.setData('name', name);
        },

        openMovie() {
            let el = document.querySelector('.popup_movie');
            el.classList.add('active');
        },

        closeMovie() {
            let el = document.querySelector('.popup_movie');
            el.classList.remove('active');
            this.name = null;
        },

        addMovie() {
            if(!this.name) {
                alert('поле не может быть пустым');
            } else {
                axios.post('/api/movie', { name: this.name })
                this.getListMovie();
                this.closeMovie();
            }
        },

        getListMovie() {
            axios.get('/api/movie')
            .then(data => {
                this.movies = data.data;
                this.$refs.session.getMovieList(this.movies);
            });
        },

        itemDelete(id) {
            axios.delete(`/api/movie${id}`)
            this.getListMovie();
            this.$refs.session.updateStyle();
        },
    },
}
</script>