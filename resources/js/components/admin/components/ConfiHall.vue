<template>
    
    <div class="conf-step__wrapper conf-hall">
        <div class="">
            <HallList ref="list"/>
        </div>
        <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
            <div class="conf-step__legend">
                <label class="conf-step__label">Рядов, шт<input type="text" class="conf-step__input inp_conf_hall" placeholder="10" v-model="row" v-on:input="rowInput"></label>
                <span class="multiplier">x</span>
                <label class="conf-step__label">Мест, шт<input type="text" class="conf-step__input inp_conf_hall" placeholder="8" v-model="place" v-on:input="placeInput"></label>
            </div>
            <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
                <div class="conf-step__legend">
                    <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
                    <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
                    <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
                    <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
                </div>  
                <div class="conf-step__hall">
                    <div class="conf-step__hall-wrapper">
                        <div v-for="(item, index) in items" v-if="this.items" :key="index" class="conf-step__row">
                            <span v-for="(childItem, i) in item" v-if="this.items" :key="childItem.id" 
                            @click.stop.prevent="toggleTypePlace($event, index, i)" 
                            class="conf-step__chair conf-step__chair_disabled">
                            </span>
                        </div>
                    </div>  
                </div>
                    
                <fieldset class="conf-step__buttons text-center">
                    <button @click.prevent="cancelBtn"  class="conf-step__button conf-step__button-regular">Отмена</button>
                    <input @click.prevent="saveBtn" type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
                </fieldset>                 
    </div>
 
</template>

<script>
import HallList from "./HallList.vue";

export default {
    name: "ConfiHall",

    components: {
        HallList
    },

    mounted() {
        console.log('Component form hall-config.');
        this.renderHall();
    },

    data() {
        return {
            halls: null,
            items: null,
            arr: [],
        }
    },

    methods: {
        rowInput() {
            this.renderHall();
        },

        placeInput() {
            this.renderHall();
        },

        renderHall() {
            if(this.row && this.place) {
                this.items = Array.from({ length: Number(this.row) }, () => Array.from({ length: Number(this.place) }, () => ''));
            } else {
                this.items = Array.from({ length: 10 }, () => Array.from({ length: 8 }, () => ''));
            }
            this.clearPlace();
        },

        clearPlace() {
            const vip = document.querySelector('.conf-step__hall-wrapper').querySelectorAll('.conf-step__chair_vip');
            vip.forEach(item => {
                item.classList.remove('conf-step__chair_vip');
                item.classList.add('conf-step__chair_disabled');
            });
            const std = document.querySelector('.conf-step__hall-wrapper').querySelectorAll('.conf-step__chair_standart');
            std.forEach(item => {
                item.classList.remove('conf-step__chair_standart');
                item.classList.add('conf-step__chair_disabled');
            });
        },

        clearInp() {
            const el = document.querySelectorAll('.inp_conf_hall');
            el.forEach(item => item.value = '');
        },

        checkRadio() {
            this.row = null;
            this.place = null;
            this.clearInp();
            this.renderHall();
            if(this.$refs.list.radio) {
                this.row = this.$refs.list.radio.row;
                this.place = this.$refs.list.radio.place;
                this.renderHall();
            }
        },

        toggleTypePlace(e, index, i) {     
            if(e.target.classList.contains('conf-step__chair_disabled')) {
                e.target.classList.remove('conf-step__chair_disabled');
                e.target.classList.add('conf-step__chair_standart');
                this.placeSeve(index, i, 'standart');
            } else if (e.target.classList.contains('conf-step__chair_standart')) {
                e.target.classList.remove('conf-step__chair_standart');
                e.target.classList.add('conf-step__chair_vip');
                this.placeSeve(index, i, 'vip');
            }  else {
                e.target.classList.remove('conf-step__chair_vip');
                e.target.classList.add('conf-step__chair_disabled');
                this.placeSeve(index, i, 'disabled');
            }
        },

        placeSeve(index, i, type) {
            if(type === 'disabled') {
                const check = this.arr.findIndex(item => item.row === index && item.place === i);
                if(check) {
                    this.arr.splice(check, 1);
                }
            } else {
                const check = this.arr.find(item => item.row === index && item.place === i);
                if(check) {
                    check.type = type;
                } else {
                    this.arr.push({row: index, place: i, type: type});
                }
            }
        },

        cancelBtn() {
            this.clearInp();
            this.clearPlace();
            this.arr = [];
        },

        saveBtn() {
            if(this.$refs.list.radio && this.row && this.place && this.items.length > 1) {
                this.UpdateHall(this.$refs.list.radio.id, { row: this.row, place: this.place });
                this.UpdatePlace(this.$refs.list.radio.id);
                for (let i = 0; i < this.arr.length; i++) { 
                    this.StorePlace({ hall_id: this.$refs.list.radio.id, type: this.arr[i].type, row: this.arr[i].row, place: this.arr[i].place });
                     
                }
            } else {
                alert('заполните все поля');
            }
            this.clearPlace();
            this.arr = [];
        },

        UpdateHall(id, data) {
            axios.put(`/api/hall${id}`, data);
            this.$parent.$refs.methodList.getListHall();
        },

        StorePlace(data) {
            axios.post('/api/place', data);
        },

        UpdatePlace(id) {
            axios.patch(`/api/place${id}`);
            this.$parent.$refs.methodList.getListHall();
        },
    }
}
</script>