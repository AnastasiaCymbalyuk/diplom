<template>
    
    <div class="conf-step__wrapper">
        <HallList ref="price"/>
                
        <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
        <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" v-model="price" v-on:input="stdInput" ></label>
            за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
        </div>  
        <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" v-model="vipPrice" v-on:input="vipInput" value="350"></label>
            за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
        </div>  
                
        <fieldset class="conf-step__buttons text-center">
            <button class="conf-step__button conf-step__button-regular" @click.prevent="cancelBtn">Отмена</button>
            <input type="submit" value="Сохранить" @click.prevent="saveBtn" class="conf-step__button conf-step__button-accent">
        </fieldset>  
                           
    </div>
 
</template>

<script>
import HallList from "./HallList.vue";

export default {
    name: "HallPrice",

    components: {
        HallList
    },

    mounted() {
        console.log('Component form hall-config.');
    },

    data() {
        return {
            halls: null,
            price: null,
            vipPrice: null,
        }
    },

    methods: {
        checkRadio() {
            if(this.$refs.price.radio) {
                this.price = this.$refs.price.radio.price;
                this.vipPrice = this.$refs.price.radio.vipPrice;
            }
        },
        
        UpdateHall(id, data) {
            axios.patch(`/api/hall${id}`, data);
            this.$parent.$refs.methodList.getListHall();
        },

        stdInput(e) {
            this.price = e.target.value;

        },

        vipInput(e) {
            this.vipPrice = e.target.value;

        },

        saveBtn() {
            if(this.price && this.vipPrice && this.$refs.price.radio.id) {
                this.UpdateHall(this.$refs.price.radio.id, { price: this.price, vipPrice: this.vipPrice})  ;
                this.price = null;
                this.vipPrice = null;
            } else {
                alert('заполните все поля');
            }
        },

        cancelBtn() {
            this.price = null;
            this.vipPrice = null;
        }
    }
}
</script>