<template>
    
    <nav class="page-nav">
        <a class="page-nav__day page-nav__day_prev" href="#" v-if="isHiddenNext" @click.stop.prevent="prevMenu"></a>
        <template v-for="(navs, index) in navsList">
            <template v-if="index >= this.startIdx && index <= this.endtIdx">
                <template v-if="index === 0">
                    <a class="page-nav__day page-nav__day_today page-nav__day_chosen" href="#" @click.stop.prevent="toggleMenu($event)">
                        <span class="page-nav__day-week" :weekday="navs.weekday">{{ navs.weekday }}</span>
                        <span class="page-nav__day-number" :day="navs.day">{{ navs.day }}</span>
                    </a>
                </template>
                <template v-else-if="navs.weekday === 'сб' || navs.weekday === 'вс'">
                    <a class="page-nav__day page-nav__day_weekend" href="#" @click.stop.prevent="toggleMenu($event)">
                        <span class="page-nav__day-week" :weekday="navs.weekday">{{ navs.weekday }}</span>
                        <span class="page-nav__day-number" :day="navs.day">{{ navs.day }}</span>
                    </a>
                </template>
                <template v-else>
                    <a class="page-nav__day" href="#" @click.stop.prevent="toggleMenu($event)">
                        <span class="page-nav__day-week" :weekday="navs.weekday">{{ navs.weekday }}</span>
                        <span class="page-nav__day-number" :day="navs.day">{{ navs.day }}</span>
                    </a>
                </template>
            </template>     
        </template>
        <a class="page-nav__day page-nav__day_next" v-if="!isHiddenNext" href="#" @click.stop.prevent="nextMenu"></a>
    </nav>
 
</template>

<script>
export default {
    name: "NavList",
    mounted() {
        this.navsCreate();
        console.log('Component form nav');
    },

    data() {
        return {
            navsList: [],
            startIdx: 0,
            endtIdx: 7,
            isHiddenNext: false,
        }
    },

    methods: {
        navsCreate() {
            if(this.navsList.length <= 0) {
                const today = new Date().getTime();
                const startOfWeek = today - today % 7 * 24 * 60 * 60;
                const endOfWeek = startOfWeek + 15 * 24 * 60 * 60 * 1000; // 1000 ms per second
    
                const date = new Date(startOfWeek);
                let day = new Date();
                day = day.getDate();
                while (date.getTime() <= endOfWeek) { 
                    const weekdayRu = date.toLocaleDateString("ru-RU", {weekday: "short"});
                    this.navsList.push({weekday: weekdayRu , day}); 
                    day = day + 1;
                    date.setDate(date.getDate() + 1);
                };
            }
        },

        toggleMenu(e) {
            const el = document.querySelector('.page-nav__day_chosen');
            if(el !== e.target.parentElement) {
                el.classList.remove('page-nav__day_chosen');
            }
            if(!e.target.parentElement.classList.contains('page-nav__day_chosen')) {
                e.target.parentElement.classList.add('page-nav__day_chosen');
            }
        },

        nextMenu() {
            this.startIdx = this.startIdx + 7;
            this.endtIdx = this.endtIdx + 7;
            if(this.endtIdx > this.navsList.length) {
                this.endtIdx = this.navsList.length;
                this.isHiddenNext = true;
            } 
        },

        prevMenu() {
            this.endtIdx = this.startIdx;
            this.startIdx = this.startIdx - 7;
            if(this.startIdx === 0) {
                this.isHiddenNext = false;
            }
        },
    }
}
</script>