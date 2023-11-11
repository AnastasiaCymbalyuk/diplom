<template>
    
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
            <li v-for="hall in halls" >
                <input type="radio" class="conf-step__radio" name="chairs-hall" v-bind:id="hall.id" v-bind:value="hall" v-model="radio" v-on:change="activeRadio" checked>
                <span class="conf-step__selector">
                    {{ hall.name }}
                </span>
            </li>
        </ul>
     
</template>

<script>
    export default {
        name: "HallList",
        mounted() {
            console.log('Component form hall-list.');
        },

        data() {
            return {
                halls: null,
                radio: null
            }
        },

        methods: {
            getList(list) {
                this.halls = list;
            },
            
            activeRadio() {
                this.$parent.$parent.$refs.list.checkRadio();
                this.$parent.$parent.$refs.hall.checkRadio();
            }
        }
    }
</script>