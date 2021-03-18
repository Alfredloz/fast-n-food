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
            <button class="btn btn-primary" :class="alreadyInCart(plate) ? 'hide' : 'show' " @click="addPlate(plate)" :disabled="alreadyInCart(plate)">
                Add to Cart
            </button>
            <button class="btn btn-danger" :class="alreadyInCart(plate) ? 'show' : 'hide' " @click="removePlate(plate)" :disabled="!alreadyInCart(plate)">
                Remove from Cart
            </button>
            <div class="quantity_wrapper" v-if="alreadyInCart(plate)">
                <button @click="decreaseQuantity(plate)"><i class="fas fa-minus-circle fa-lg fa-fw"></i></button>
                <input type="number" :value="getPlateQuantity(plate)" disabled>
                <button @click="increaseQuantity(plate)"><i class="fas fa-plus-circle fa-lg fa-fw"></i></button>
            </div>
        </div>

        <h2 class="my-4 storage">IN STORAGE (E in un futuro carrello)</h2>
        <div>
            <div v-for="plate in plates_bought" :key="plate.id">
                <h3>{{plate.name}}</h3>
                <h3>Quantità{{getPlateQuantity(plate)}}</h3>
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
                    // If the cart content come from another restaurant, i remove it
                    if ( this.plates_bought[0].user_id != this.restaurant_info.id) {
                        localStorage.removeItem('plates_bought');
                        this.plates_bought = [];
                    }
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
                plate['quantity'] = 1;
                plate['user_id'] = this.restaurant_info.id;
                this.plates_bought.push(plate);
                this.savePlate();
            },
            removePlate(plate){
                plate['quantity'] = 0;
                const position = this.getBoughtPosition(plate);

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
                const position = this.getBoughtPosition(plate);
                return position != -1; // position != -1 means that the plate is already in cart
            },
            /**
             * Get the position of a plate bought in the plates_bought array, -1 otherwise
             * 
             * @param plate - the plate to look for
             * @return the position of the plate or -1 if the plate is not in plates_bought
            */
            getBoughtPosition(plate){
                return this.plates_bought.findIndex(element => {
                    return element.id == plate.id;
                });
            },
            increaseQuantity(plate){
                const position = this.getBoughtPosition(plate);
                if(position == -1) return

                const oldQuantity = this.plates_bought[position].quantity;
                const oldPlate = this.plates_bought[position];
                oldPlate.quantity = oldQuantity + 1;
                // splice and push back:  necessary for VUE to notice the change in the quantity of the plate
                this.plates_bought.splice(position, 1);
                this.plates_bought.push(oldPlate);
                
                this.savePlate();
            },
            decreaseQuantity(plate){
                const position = this.getBoughtPosition(plate);
                
                if(position == -1) return
                
                if(this.plates_bought[position].quantity <= 1){
                    this.removePlate(plate);
                    return
                }

                const oldQuantity = this.plates_bought[position].quantity;
                const oldPlate = this.plates_bought[position];
                oldPlate.quantity = oldQuantity - 1;

                // splice and push back:  necessary for VUE to notice the change in the quantity of the plate
                this.plates_bought.splice(position, 1);
                this.plates_bought.push(oldPlate);
                
                this.savePlate();
            },
            getPlateQuantity(plate) {
                const position = this.getBoughtPosition(plate);
                if (position == -1) return 0;

                return this.plates_bought[position].quantity;
            }
        }
    }
</script>

<style lang="scss" scoped>
    button.hide{
        display: none;
    }

    button.show{
        display: inline-block;
    }
</style>