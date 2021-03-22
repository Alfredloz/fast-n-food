<template>
    <div class="home-component">
        <div class="typologies">
            <div class="slider-container">
                <div class="slider-container-2">
                    <h1>Seleziona una o più tipologie</h1>
                        <div class="slider-container-3">
                            <button id="slideBack" type="button"><i class="fas fa-caret-left"></i></button>
                            <div id="slider-typologies">
                                <div class="form-check"  v-for="typology in typologies" :key="typology.id">
                                    <label class="form-check-label checkbox">
                                        <input style="opacity: 0.2" type="checkbox" class="form-check-input" :id="'typology' + typology.id" :value="typology.id" v-model="typologies_ids">
                                        <img :src="typology.img" class="" alt="">
                                        <span>{{typology.name}}</span>
                                    </label>
                                </div>
                            </div>
                            <button id="slide" type="button"><i class="fas fa-caret-right"></i></button>
                        </div>  
                </div>
            </div>
        
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
