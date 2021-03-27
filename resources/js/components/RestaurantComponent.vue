<template>
    <div class="">
        <div class="restaurant-logo-name">
            <div class="restaurant-logo">
                <img :src="'/storage/'+restaurant_info.restaurant_logo" alt="">
            </div>
            <div class="restaurant-name">
                <h1><i class="fas fa-utensils"></i> {{restaurant_info.restaurant_name}}</h1>
                <h3><em>{{restaurant_info.restaurant_description}}</em></h3>
                <div>
                    <h6><i class="fas fa-map-marker-alt"></i><b>{{restaurant_info.address}}</b></h6>
                    <p><i class="fas fa-phone"></i><b>{{restaurant_info.phone_number}}</b></p>
                </div>
            </div>
        </div>

        <div class="no-plates" v-if="noPlates">
            <h2>Il ristorante è momentaneamente chiuso</h2>
        </div>

        <h2 v-if="!noPlates">I più venduti <i class="fas fa-hamburger"></i></h2>
        <div class="plate-list">
            <div class="plate" v-for="plate in visiblePlates" :key="plate.id">
                <div class="plate-image">
                    <img :src="'/storage/'+plate.picture" alt="">
                </div>
                <div class="plate-info">
                    <div class="plate_info_description">
                        <h3>{{plate.name}}</h3>
                        <p>{{plate.description_ingredients}}</p>
                        <h5>€ {{plate.price}}</h5>
                    </div>
                    <div class="quantity-plate">
                        <div>
                            <button class="add-cart-btn" :class="alreadyInCart(plate) ? 'hide' : 'show' " @click="addPlate(plate)" :disabled="alreadyInCart(plate)">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                            <button class="remove-item-btn" :class="alreadyInCart(plate) ? 'show' : 'hide' " @click="removePlate(plate)" :disabled="!alreadyInCart(plate)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                        <div v-if="alreadyInCart(plate)">
                            <span>Quantity: {{getPlateQuantity(plate)}}x</span>
                            <button class="less-plus-button" @click="decreaseQuantity(plate)"><i class="fas fa-minus-circle fa-lg fa-fw"></i></button>
                            <button class="less-plus-button" @click="increaseQuantity(plate)"><i class="fas fa-plus-circle fa-lg fa-fw"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {eventBus} from '../app';

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
            // Listen for the event localStorageUpdated
            eventBus.$on('CartLocalStorageUpdated', () =>{
                this.checkLocalStorage();
            })
        },
        mounted() {
            this.checkLocalStorage();
        },
        computed : {
            visiblePlates(){
                return this.plates_info.filter((plate)=>{
                    return plate.visibility == 1;
                })
            },
            noPlates(){
                return this.visiblePlates.length == 0;
            }
        },
        methods : {
            checkLocalStorage(){
                if (localStorage.getItem('plates_bought')) {
                    try {
                        this.plates_bought = JSON.parse(localStorage.getItem('plates_bought'));
                        // If the cart content come from another restaurant, i remove it
                        if ( this.plates_bought[0].user_id != this.restaurant_info.id) {
                            localStorage.removeItem('plates_bought');
                            this.plates_bought.splice(0, this.plates_bought.length);
                        }
                    } catch(e) {
                        localStorage.removeItem('plates_bought');
                    }
                }
            },
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
                // Emit the event localStorageUpdated through the eventBus
                eventBus.$emit('RestaurantLocalStorageUpdated');
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
