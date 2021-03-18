<template>
    <div class="container">
     
        <h2>Ristorante</h2>
        <div class="restaurant">
            <h3>{{restaurant_info.restaurant_name}}</h3>
        </div>
        
        <h2>Menu</h2>
        <div class="plate my-2" v-for="plate in visiblePlates" :key="plate.id">
            <h3>{{plate.name}}</h3>
            <h4>{{plate.description_ingredients}}</h4>
            <button class="btn btn-primary" @click="addPlate(plate)" :disabled="alreadyInCart(plate)">Add to Cart</button>
            <button class="btn btn-danger" @click="removePlate(plate)" :disabled="!alreadyInCart(plate)">Remove from Cart</button>
        </div>

        <h2 class="my-4 storage">IN STORAGE (E in un futuro carrello)</h2>
        <div>
            <div v-for="plate in plates_bought" :key="plate.id">
                <h3>{{plate.name}}</h3>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        props: ["restaurant", "plates"],
        data(){
            return {
                plates_info: null,
                restaurant_info: null,
                plates_bought: []
            }
        },
        created() {
            this.restaurant_info = JSON.parse( this.restaurant );
            this.plates_info = JSON.parse( this.plates );
        },
        mounted() {
            if (localStorage.getItem('plates_bought')) {
                try {
                    this.plates_bought = JSON.parse(localStorage.getItem('plates_bought'));
                } catch(e) {
                    localStorage.removeItem('plates_bought');
                }
            }
        },
        computed : {
            visiblePlates(){
                return this.plates_info.filter((plate)=>{
                    return plate.visibility == 1;
                })
            }
        },
        methods : {
            addPlate(plate){
                this.plates_bought.push(plate)
                this.savePlate();
            },
            removePlate(plate){
                const position = this.plates_bought.findIndex(element => {
                    return element.id == plate.id;
                });

                if(position != -1){
                    this.plates_bought.splice(position, 1);
                    this.savePlate();
                }
            },
            savePlate(){
                const parsed = JSON.stringify(this.plates_bought);
                localStorage.setItem('plates_bought', parsed);
            },
            alreadyInCart(plate){
                const position = this.plates_bought.findIndex(element => {
                    return element.id == plate.id;
                });

                return position != -1; // position != -1 means that the plate is already in cart
            }
        }
    }
</script>
