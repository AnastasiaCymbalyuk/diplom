<template>
    <section class="ticket">
      
      <header class="tichet__check">
        <h2 class="ticket__check-title">Электронный билет</h2>
      </header>
      
      <div class="ticket__info-wrapper">
        <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{this.$route.query.movie}}</span></p>
        <p class="ticket__info">Места: <span class="ticket__details ticket__chairs">{{ JSON.parse(this.$route.query.arr).map(i => 'место' + (i.place + 1) + ' ряд' + (i.row + 1)).join(", ") }}</span></p>
        <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{this.$route.query.hall}}</span></p>
        <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{this.$route.query.time + ', ' }}{{ this.$route.query.date }}</span></p>
        
        <div class="ticket__info-qr" v-html="JSON.parse(this.$route.query.qr)"></div>

        <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
        <p class="ticket__hint">Приятного просмотра!</p>
      </div>
    </section>     
 
</template>
    
<script>
export default {
    name: "Ticket",
    mounted() {
        this.addTicket();
        console.log('Component form ticket');
    },
    
    data() {
        return {
            arr: JSON.parse(this.$route.query.arr),
        }
    },
    
    methods: {
        addTicket() {
          this.arr.forEach(el => {
            axios.post('/api/ticket', { 
              place_id: el.place_id,
              session_id: el.session_id,
              date: el.date,
              type: el.type,
              price: Number(el.price),
              row: el.row,
              place: el.place,
              qr: JSON.stringify(this.$route.query.qr),
            });
          });
        }
    }
}
</script>