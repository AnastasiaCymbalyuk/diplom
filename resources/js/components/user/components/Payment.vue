<template>
    <section>
        <header class="tichet__check">
            <h2 class="ticket__check-title">Вы выбрали билеты:</h2>
        </header>
      
        <div class="ticket__info-wrapper">
            <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{this.$route.query.movie}}</span></p>
            <p class="ticket__info">Места: <span class="ticket__details ticket__chairs">{{ JSON.parse(this.$route.query.arr).map(i => 'место' + (i.place + 1) + ' ряд' + (i.row + 1)).join(", ") }}</span></p>
            <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{this.$route.query.hall}}</span></p>
            <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{this.$route.query.time + ', ' }}{{ this.$route.query.date }}</span></p>
            <p class="ticket__info">Стоимость: <span class="ticket__details ticket__cost">{{JSON.parse(this.$route.query.arr).reduce((total, item) => total + Number(item.price), 0)}}</span> рублей</p>

            <button class="acceptin-button" @click="clickTicket" >Получить код бронирования</button>

            <p class="ticket__hint">После оплаты билет будет доступен в этом окне, а также придёт вам на почту. Покажите QR-код нашему контроллёру у входа в зал.</p>
            <p class="ticket__hint">Приятного просмотра!</p>
        </div>
    </section> 
 
</template>
    
<script>
export default {
    name: "Payment",
    mounted() {
        console.log('Component form payment');
    },
    
    data() {
        return {
            qr: null,
            id: JSON.parse(this.$route.query.arr).map(i => 'place' + i.place_id + 'session' + i.session_id).join("-"),
        }
    },
    
    methods: {
        clickTicket() {
            axios.get(`/api/qr${JSON.stringify(this.id)}`)
            .then(data => {
                this.qr = data.data;
                this.$router.push({
                name: 'ticket', 
                path: '/ticket',
                query: {
                    arr: this.$route.query.arr,
                    hall: this.$route.query.hall,
                    time: this.$route.query.time,
                    movie: this.$route.query.movie,
                    date: this.$route.query.date,
                    qr: JSON.stringify(this.qr)
                }
            });
            });

            
        },
    }
}
</script>