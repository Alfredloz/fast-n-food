<template>
    <div class="container">
        <h1>Home Page</h1>
        
        <div class="row">
            <div class="col-md-2">
                <h3>Tipologie</h3>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="all" value="0" name="typology_id" v-model="typology_id" checked>
                    All
                  </label>
                </div>

                <div class="form-check"  v-for="typology in typologies" :key="typology.id">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" :id="'typology' + typology.id" :value="typology.id" name="typology_id" v-model="typology_id">
                    {{typology.name}}
                  </label>
                </div>
            </div>

            <div class="col-md-10">
                <h3>Ristoranti</h3>
                <div class="restaurant"  v-for="restaurant in restaurants" :key="restaurant.id">
                  <h4>{{restaurant.restaurant_name}}</h4>
                  <h5>Tipologie del ristorante</h5>
                  <ul>
                      <li v-for="type in restaurant.typologies" :key="type.id">{{type.name}}</li>
                  </ul>
                </div>
            </div>
            
        </div>
        
    </div>
</template>

<script>
    export default {
        data(){
            return {
                typologies: null,
                restaurants: null,
                typology_id: 0
            }
        },
        watch :{
            typology_id: {
                handler(){
                    this.loadRestaurants();
                }
            }
        },
        methods: {
            loadTypologies() {
                axios.get('api/typologies')
                    .then(response => {
                        this.typologies = response.data.data
                    })
                    .catch(error => console.log(error))
            },

            loadRestaurants() {
                axios.get('api/restaurants', { params: {typology_id: this.typology_id} })
                    .then(response => {
                        this.restaurants = response.data.data
                    })
                    .catch(error => console.log(error))
            }
        },
        mounted() {
            this.loadTypologies();
            this.loadRestaurants();       
        }
    }
</script>
