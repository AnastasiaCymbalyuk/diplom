<template>
    <section class="buying">
      <div class="buying__info">
        <div class="buying__info-description">
          <h2 class="buying__info-title">{{this.$route.query.movieName}}</h2>
          <p class="buying__info-start">{{this.$route.query.sessionTime}}</p>
          <p class="buying__info-hall">{{this.$route.query.hallName}}</p>          
        </div>
        <div class="buying__info-hint">
          <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
      </div>
      <div class="buying-scheme">
        <div class="buying-scheme__wrapper">
          <div class="buying-scheme__row" :index="i" v-for="(row, i) in Number(this.$route.query.hallRow)">
            <span class="buying-scheme__chair buying-scheme__chair_disabled" @click.prevent="clickPlace($event, i, el)" :index="el" v-for="(place, el) in Number(this.$route.query.hallPlace)"></span>
            </div>
        </div>
        <div class="buying-scheme__legend">
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value">{{this.$route.query.hallPrice}}</span>руб)</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value">{{this.$route.query.hallVipPrice}}</span>руб)</p>            
          </div>
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>                    
          </div>
        </div>
      </div>
      <button class="acceptin-button" type="button" @click.prevent="clickTicket" >Забронировать</button>
    </section>     
 
</template>
    
<script>
export default {
    name: "Seances",
    mounted() {
        this.getlistPlaces();
        console.log('Component form seances');
    },
    
    data() {
        return {
            place: [],
            date: null,
            arr: [],
            ticket:[],
        }
    },
    
    methods: {
        clickTicket() {
            if(this.arr.length > 0 ) {
                this.$router.push({
                    name: 'payment', 
                    path: '/payment',
                    query: {
                        arr: JSON.stringify(this.arr),
                        hall: this.$route.query.hallName,
                        time: this.$route.query.sessionTime,
                        movie: this.$route.query.movieName,
                        date: this.date
                    }
                });
            } else {
                alert('выберите места');
            }
            
        },

        getlistDisabledPlaces() {
            axios.get('/api/ticket')
            .then(data => {
                let arr = [];  
                data.data.forEach(el => {
                    if(String(el.date) === String(this.date)) {
                        if(Number(this.$route.query.sessionId) === el.session_id) {
                            arr.push(el);
                        }
                    }
                });
                this.ticket = arr;
                this.ticketCheck();
            });
        },

        getlistPlaces() {
            axios.get('/api/place')
            .then(data => {
                let arr = [];  
                data.data.forEach(el => {
                    if(Number(this.$route.query.hallId) === el.hall_id) {
                        arr.push(el);
                    }
                });
                this.place = arr;
                this.typePlace();
                this.dateCheck();
                this.getlistDisabledPlaces();
            });
        },

        dateCheck() {
            this.date = `${document.querySelector('.page-nav__day_chosen').querySelector('.page-nav__day-week').textContent}`+
            `${document.querySelector('.page-nav__day_chosen').querySelector('.page-nav__day-number').textContent}`;
        },

        ticketCheck() {
            const row = document.querySelectorAll('.buying-scheme__row');
            this.ticket.forEach(el => {
                const place = Array.from(Array.from(row).find((i, index) => index === el.row).querySelectorAll('.buying-scheme__chair')).find((i, index) => index === el.place);
                place.classList.add('buying-scheme__chair_taken');
                if(el.type === 'vip') {
                    place.classList.remove('buying-scheme__chair_vip');
                }
                if(el.type === 'standart') {
                    place.classList.remove('buying-scheme__chair_standart');
                }
            });
        },

        typePlace() {
            const row = document.querySelectorAll('.buying-scheme__row');
            this.place.forEach(el => {
                const place = Array.from(Array.from(row).find((i, index) => index === el.row).querySelectorAll('.buying-scheme__chair')).find((i, index) => index === el.place);
                place.classList.remove('buying-scheme__chair_disabled');
                if(el.type === 'vip') {
                    place.classList.toggle('buying-scheme__chair_vip');
                }
                if(el.type === 'standart') {
                    place.classList.toggle('buying-scheme__chair_standart');
                }
            });
        },

        clickPlace(e, row, place) {
            if (!e.target.classList.contains('buying-scheme__chair_disabled') && !e.target.classList.contains('buying-scheme__chair_taken')) {
                if(e.target.classList.contains('buying-scheme__chair_vip')) {
                    this.addTicket(row, place);
                    e.target.classList.remove('buying-scheme__chair_vip');
                    e.target.classList.add('buying-scheme__chair_selected');
                } else if (e.target.classList.contains('buying-scheme__chair_standart')) {
                    this.addTicket(row, place);
                    e.target.classList.remove('buying-scheme__chair_standart');
                    e.target.classList.add('buying-scheme__chair_selected');
                } else {
                    this.checkTicket(row, place);
                    e.target.classList.remove('buying-scheme__chair_selected');
                    if(this.place.find(i => i.row === row && i.place === place).type === 'vip') {
                        e.target.classList.add('buying-scheme__chair_vip');
                    } else {
                        e.target.classList.add('buying-scheme__chair_standart');
                    }
                }
            }
        },

        checkTicket(row, place) {
            const elID = this.place.find(i => i.row === row && i.place === place).id;
            this.arr = this.arr.filter(i => i.place_id !== elID);
        },

        addTicket(row, place) {
            this.arr.push({ 
                place_id: this.place.find(i => i.row === row && i.place === place).id,
                session_id: Number(this.$route.query.sessionId),
                type: this.place.find(i => i.row === row && i.place === place).type,
                price: this.place.find(i => i.row === row && i.place === place).type === 'vip' ? this.$route.query.hallVipPrice : this.$route.query.hallPrice,
                row: row,
                place: place,
                date: this.date
            });
        },
    }
}
</script>