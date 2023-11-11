<template>
    <div class="conf-step__seances">
            <div class="conf-step__seances-hall" v-for="hall in halls" :key="hall.id">
                <h3 class="conf-step__seances-title">{{ hall.name }}</h3>
                <div class="conf-step__seances-timeline" :id="hall.id">
                    <template v-for="(item, index) in 12">
                        <div class="conf-step__seances-movie drop show-before" :id="index" :style="{ 'left': index * 60 + 'px', 'width': 60 + 'px' }" 
                        @dragleave.prevent="leave($event)" @dragenter.prevent="enter($event)" @dragover.prevent @drop="drop($event, hall, index)"
                        @click.prevent="deleteSession($event.currentTarget, hall.id, index)">
                        </div>
                    </template>
                </div>
            </div>
            <div class="popup popup_session">
                <div class="popup__container">
                    <div class="popup__content">
                        <div class="popup__header">
                            <h2 class="popup__title">
                                Добавление сеанса
                                <a class="popup__dismiss" href="#"><img src="i/admin/close.png" alt="Закрыть" @click.prevent="closeSession" ></a>
                            </h2>
                        </div>
                        <div class="popup__wrapper">
                            <form action="{{ route('session.store') }}" method="post" accept-charset="utf-8">
                                <label class="conf-step__label conf-step__label-fullsize" for="hall_list">
                                    Название зала
                                    <input class="conf-step__input" :value="hall_name" v-model="hall_id" name="hall_id" required disabled>
                                </label>
                                <label class="conf-step__label conf-step__label-fullsize" for="start_time">
                                    Время начала
                                    <input class="conf-step__input" type="time" :value="movie_time" v-model="start_time" name="start_time" required>
                                </label>
                                <label class="conf-step__label conf-step__label-fullsize" for="movie_list">
                                    Название фильма
                                    <input class="conf-step__input" :value="movie_name" v-model="movie_id" name="movie_list" required disabled>
                                </label>
                                <div class="conf-step__buttons text-center">
                                    <input type="submit" value="Добавить" class="conf-step__button conf-step__button-accent" @click.prevent="previewSession">
                                    <button class="conf-step__button conf-step__button-regular" type="button" @click.prevent="closeSession">Отменить</button>            
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <fieldset class="conf-step__buttons text-center">
            <button class="conf-step__button conf-step__button-regular" @click.prevent="sessionClear">Отмена</button>
            <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent" @click.prevent="addSession">
        </fieldset> 
</template>

<script>
export default {
    name: "HallList",
    mounted() {
        console.log('Component form session-list.');
        
    },

    data() {
        return {
            arr: [],

            hall_id: null,
            start_time: null,
            movie_id: null,
            index_el: null,

            halls: null,
            movies: null,

            computedStyle: null,
            activeEl: null,
            moviId: null,
            moviName: null,
        }
    },

    methods: {
        removeHallList() {
            this.sessionClear();
        },

        updateStyle() {
            const listSesion = document.querySelectorAll('.conf-step__seances-movie');
            listSesion.forEach(el => {
                this.deleteSession(el, el.parentElement.id, el.id);
            });
            this.arr = [];
        },
    
        toggleClass(el) {
            el.classList.remove("hovered");
            el.classList.toggle("drop");
            el.classList.toggle("show-before");
        },

        drop(e, hall, index) {
            e.currentTarget.classList.remove("hovered");
            if (e.currentTarget.childNodes.length > 0) {
                this.deleteSession(e.currentTarget, hall.id, index);
            }
            this.moviId = e.dataTransfer.getData('id');
            this.moviName = e.dataTransfer.getData('name');
            const check = document.querySelectorAll('.conf-step__movie');
            const movieEl = Array.from(check).find(i => i.id === this.moviId);
            this.computedStyle = getComputedStyle(movieEl, ':nth-of-type').backgroundColor;
            this.activeEl = e.currentTarget;
            this.openSession(this.moviName, this.moviId, hall, index);
        },

        successDrop() {
            this.toggleClass(this.activeEl);
            this.activeEl.style.backgroundColor = this.computedStyle;
            const truncateString = this.moviName.length > 10 ? this.moviName.slice(0, 10) + "..." : this.moviName;
            this.activeEl.insertAdjacentHTML('afterbegin', `
                <p class="conf-step__seances-movie-title" :id="${this.moviId}">${truncateString}</p>
                <p class="conf-step__seances-movie-start" >${this.start_time}</p>
            `);
        },

        enter(e) {
            e.currentTarget.classList.add("hovered");
        },

        leave(e) {
            e.currentTarget.classList.remove("hovered");
        },

        getList(list) {
            this.halls = list;
        },

        getMovieList(data) {
            this.movies = data;
        },

        openSession(movieName, movieId, hall, index) {
            let el = document.querySelector('.popup_session');
            el.classList.add('active');
            this.hall_name = hall.name;
            this.hall_id = hall.id;
            this.movie_name = movieName;
            this.movie_id = movieId;
            this.index_el = index;
        },

        closeSession() {
            let el = document.querySelector('.popup_session');
            el.classList.remove('active');
            this.hall_id = null;
            this.start_time = null;
            this.movie_id = null;
            this.index_el = null;
        },

        checkSession() {
            let res = true;
            document.querySelectorAll('.conf-step__seances-timeline').forEach(i => {
                if(i.querySelectorAll('.conf-step__seances-movie-title').length === 0) {
                    res = false;
                };
            })
            return res;
        },

        addSession() {
            if(this.arr.length > 0) {
                if(this.checkSession()) {
                    this.arr.forEach(i => {
                        this.updateSession(i.session.hall_id);
                    });
                    for (let i = 0; i < this.arr.length; i++) {
                        this.storeSession({ hall_id: this.arr[i].session.hall_id, time: this.arr[i].session.time, movie_id: this.arr[i].session.movie_id });
                    }
                    this.sessionClear();
                } else {
                    alert('заполните расписание сеансов для всех залов');
                }
            } else {
                alert('заполните расписание сеансов для всех залов');
            }
        },

        storeSession(data) {
            axios.post('/api/session', data); 
        },

        updateSession(id) {
            axios.patch(`/api/session${id}`);
        },

        deleteSession(e, hallId, index) {
            if (e.childNodes.length > 0) {
                this.toggleClass(e);
                e.style.backgroundColor = '';
                e.replaceChildren();
                const check = this.arr.findIndex(el => el.index === index && el.session.hall_id === hallId);
                if(check) {
                    this.arr.splice(check, 1);
                }
            }
        },

        previewSession() {
            if(!this.hall_id || !this.start_time || !this.movie_id) {
                alert('заполните поля');
            } else {
                this.arr.push({ index: this.index_el, session: { hall_id: this.hall_id, time: this.start_time, movie_id: this.movie_id }});
                this.successDrop();
                this.closeSession();
            }
        },

        sessionClear() {
            this.updateStyle();
        },
    },
}
</script>

<style>
    .drop {
        border: none;
    }

    .hovered {
        background-color: rgba(195, 0, 255, 0.2);
    }

    .show-before::before {
        display: none;
    }
</style>