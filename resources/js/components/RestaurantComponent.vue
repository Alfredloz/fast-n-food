<template>
    <div class="container">
     
        <h2>Ristorante</h2>
        <div class="restaurant">
            <h3>{{restaurant_info.restaurant_name}}</h3>
        </div>
        
        <h2>Menu</h2>
        <div class="plate" v-for="plate in visiblePlates" :key="plate.info">
            <h3>{{plate.name}}</h3>
            <h4>{{plate.description_ingredients}}</h4>
        </div>
        
    </div>
</template>

<script>
    export default {
        props: ["restaurant", "plates"],
        data(){
            return {
                plates_info: null,
                restaurant_info: null
            }
        },
        created() {
            this.restaurant_info = JSON.parse( this.restaurant );
            this.plates_info = JSON.parse( this.plates );
        },
        computed : {
            visiblePlates(){
                return this.plates_info.filter((plate)=>{
                    return plate.visibility == 1;
                })
            }
        }
    }
</script>
