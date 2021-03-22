<template>
    <div class="home-component">
        <div class="typologies">
            <!-- <h1>Seleziona una o più tipologie</h1>
            <div class="col-md-12 checkboxes">
                <div class="form-check"  v-for="typology in typologies" :key="typology.id">
                  <label class="form-check-label checkbox">
                    <input type="checkbox" class="form-check-input" :id="'typology' + typology.id" :value="typology.id" v-model="typologies_ids">
                    {{typology.name}}
                  </label>
                </div>
            </div> -->

            <h1>Ristoranti</h1>
            <div class="restaurant-list">
                <div v-for="restaurant in restaurants" :key="restaurant.id">
                    <a :href="/restaurant/+restaurant.slug">
                        <div class="restaurant">
                            <div class="restaurant-info">
                                <img :src="'/storage/'+restaurant.restaurant_banner" alt="">
                                <h4>{{restaurant.restaurant_name}}</h4>
                                <p>{{restaurant.restaurant_description}}</p>
                                <!-- <h5>Tipologie del ristorante</h5>
                                <ul>
                                    <li v-for="type in restaurant.typologies" :key="type.id">{{type.name}}</li>
                                </ul> -->
                            </div>
                        </div>
                    </a>
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
                typologies_ids: []
            }
        },
        watch :{
            typologies_ids: {
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
                axios.get('api/restaurants', { params: { typologies_ids: this.typologies_ids} })
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
