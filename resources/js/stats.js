require('./bootstrap');
import Vue from 'vue';

const stats = new Vue({
  el: '#stats',
  data: {
    year: new Date().getFullYear()
  },
  methods: {
   
    filterByYear(){
      Vue.prototype.$userId = document.querySelector("meta[name='user']").getAttribute('content');
      let userSlug = JSON.parse(Vue.prototype.$userId).slug;
      let monthsPrice = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      let yearPrice = 0;

      axios
        .get('http://127.0.0.1:8000/api/orders/' + userSlug)
        .then(
          (response) => {

            let orders = response.data;
            const self = this;


            orders.forEach(
              (element) => {
                let orderCreateDate = element.created_at; 
                let orderTotalPrice = element.total_price;

                if(orderCreateDate.substr(0, 4) == self.year){
                  for(var i = 0; i <= 12; i++){
                    if(orderCreateDate.substr(5, 2) == i){
                     monthsPrice[i - 1] += orderTotalPrice;
                    }
                  }
                }
              }
            );

            //Guadagno totale dell'anno
           monthsPrice.forEach(
              (element) => {
                yearPrice += element;
              }
            );

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
            type: 'line',

            data: {
                labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                datasets: [{
                label: "Guadagno totale: " + yearPrice.toFixed(2) + "€",
                backgroundColor: 'rgba(255, 168, 3 , 0.4)',
                borderColor: 'rgb(255, 168, 3)',
                data: monthsPrice,
              }]
            },
            options: {
              legend: {
                  labels: {
                      // This more specific font property overrides the global property
                      fontSize: 16,
                  }
              },
          }

            });

          }
        );
      }
  },

  mounted() {
    this.filterByYear();
  }
});