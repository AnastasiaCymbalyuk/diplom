<template>
    <div>
        <main class="conf-steps">
            <section class="conf-step">
                <header class="conf-step__header conf-step__header_opened">
                    <h2 class="conf-step__title">Управление залами</h2>
                </header>
                <!-- hall form  -->
                <Hall ref="methodList"/>
            </section>
            
            <section class="conf-step">
                <header class="conf-step__header conf-step__header_opened">
                    <h2 class="conf-step__title">Конфигурация залов</h2>
                </header>
                <!-- hall list  -->
                <ConfiHall ref="list"/>
            </section>
            
            <section class="conf-step">
                <header class="conf-step__header conf-step__header_opened">
                    <h2 class="conf-step__title">Конфигурация цен</h2>
                </header>
                <!-- hall price  -->
                <HallPrice ref="hall"/>
            </section>
            
            <section class="conf-step">
                <header class="conf-step__header conf-step__header_opened">
                    <h2 class="conf-step__title">Сетка сеансов</h2>
                </header>
                <SessionConfig ref="movie"/>
            </section>
            
            <section class="conf-step">
            <header class="conf-step__header conf-step__header_opened">
                <h2 class="conf-step__title">Открыть продажи</h2>
            </header>
            <div class="conf-step__wrapper text-center">
                <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
                <button class="conf-step__button conf-step__button-accent" type="button" @click.prevent="checkDatabase($event)">Открыть продажу билетов</button>
            </div>
            </section>    
        </main>
    </div>
    
</template>

<script>
    import Hall from "./components/Hall.vue";
    import ConfiHall from "./components/Confihall.vue";
    import HallPrice from "./components/HallPrice.vue";
    import SessionConfig from "./components/SessionConfig.vue";

    export default {
        components: {
            Hall,
            ConfiHall,
            HallPrice,
            SessionConfig,
        },

        mounted() {
            console.log('Component form admin.')
            this.accordeon();
        },

        data() {
            return {

            }
        },

        methods: {
            accordeon() {
                const headers = Array.from(document.querySelectorAll('.conf-step__header'));
                headers.forEach(header => header.addEventListener('click', () => {
                    header.classList.toggle('conf-step__header_closed');
                    header.classList.toggle('conf-step__header_opened');
                }));
            },

            async checkDatabase(e) {
                try {
                    const getHalls = axios.get('/api/hall');
                    const getSession = axios.get('/api/session');
                    const getPlaces = axios.get('/api/place');

                    Promise.all([getHalls, getSession, getPlaces]).then(function(values) {
                        const halls = values[0].data;
                        const sessions = values[1].data;
                        const places = values[2].data;
                        let checkHall = true;
                        let value;
                        let valueNew;
                        
                        for (let i = 0; i < halls.length; i++) {
                            if(!halls[i].name || !halls[i].row || !halls[i].place || !halls[i].price || !halls[i].vipPrice) {
                                checkHall = false;  
                            }
                            const checkSession = Array.from(sessions).find(el => el.hall_id === halls[i].id);
                            const checkPlace = Array.from(places).find(el => el.hall_id === halls[i].id);
                            if(!checkSession || !checkPlace) {
                                checkHall = false;
                            }
                        }
                        
                        if(!checkHall) {
                            if(e.target.textContent === 'Приостановить продажу билетов') {
                                value = 1;
                                valueNew = 0;
                                e.target.textContent = 'Открыть продажу билетов';
                                axios.put(`/api/hall/active${value}${valueNew}`);
                            }
                            alert('заполните всю информацию');
                        } else {
                            if(e.target.textContent === 'Приостановить продажу билетов') {
                                value = 1;
                                valueNew = 0;
                                e.target.textContent = 'Открыть продажу билетов';
                                axios.put(`/api/hall/active${value}${valueNew}`);
                            } else {
                                value = 0;
                                valueNew = 1;
                                e.target.textContent = 'Приостановить продажу билетов';
                                axios.put(`/api/hall/active${value}${valueNew}`);
                            }
                        }
                    });
                } catch (err) {
                    console.error(err);
                }
            }
        }
    }
</script>