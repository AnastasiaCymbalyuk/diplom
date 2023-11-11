<template>
    <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Доступные залы:</p>
        <ul class="conf-step__list" >
            <li v-for="hall in halls">
                {{ hall.name }}
                <button class="conf-step__button conf-step__button-trash" @click.prevent="itemDelete(hall.id)"></button>
            </li>
        </ul>
        <button class="conf-step__button conf-step__button-accent" type="button" @click="toggleOpen">Создать зал</button>
        <div class="popup">
            <div class="popup__container">
                <div class="popup__content">
                    <div class="popup__header">
                        <h2 class="popup__title">
                            Добавление зала
                            <a class="popup__dismiss" href="#"><img src="i/admin/close.png" alt="Закрыть" @click.prevent="toggleClose"></a>
                        </h2>
                    </div>
                    <div class="popup__wrapper">
                        <form action="{{ route('hall.store') }}" method="post" accept-charset="utf-8">
                            <label class="conf-step__label conf-step__label-fullsize" for="name">
                                Название зала
                                <input class="conf-step__input" type="text" v-model="name" placeholder="Например, &laquo;Зал 1&raquo;" name="name" required>
                            </label>
                            <div class="conf-step__buttons text-center">
                                <input type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent" @click.prevent="addHall">
                                <button class="conf-step__button conf-step__button-regular" type="button" @click.prevent="toggleClose">Отменить</button>            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Hall",
        mounted() {
            this.getListHall();
            console.log('Component form hall.')
        },

        data() {
            return {
                name: null,
                halls: null,
            }
        },

        methods: {
            toggleOpen() {
                let el = document.querySelector('.popup');
                el.classList.add('active');
            },

            toggleClose() {
                let el = document.querySelector('.popup');
                el.classList.remove('active');
                this.name = null;
            },

            addHall() {
                if(!this.name) {
                    alert('поле не может быть пустым');
                } else {
                    axios.post('/api/hall', { name: this.name })
                    this.getListHall();
                    this.toggleClose();
                }
            },

            getListHall() {
                axios.get('/api/hall')
                .then(data => {
                    this.halls = data.data;
                    this.$parent.$refs.list.$refs.list.getList(this.halls);
                    this.$parent.$refs.hall.$refs.price.getList(this.halls);
                    this.$parent.$refs.movie.$refs.session.getList(this.halls);
                });
            },

            itemDelete(id) {
                axios.delete(`/api/hall${id}`)
                this.getListHall();
                this.$parent.$refs.movie.$refs.session.removeHallList(id);
            },
        }
    }
</script>