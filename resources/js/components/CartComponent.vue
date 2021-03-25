<template>
    <div class="cart">
        
        <div class="shopping"><i class="fas fa-cart-arrow-down"></i><h1>Carrello</h1></div>
        <div class="shopping"><img width="140px" src="/images/Artwork.svg"></div>
        <div>
            
            <div v-for="plate in plates_bought" :key="plate.id">
                <h4>{{plate.name}}</h4>
                <button class="remove-cart-btn" @click="removePlate(plate)">
                    <i class="fas fa-trash-alt"></i> Rimuovi dal Carrello
                </button>
                <h5>Quantità: {{getPlateQuantity(plate)}}x</h5>
                <hr>
                <h6>€ {{plate.price}}</h6>
                <hr>

                <div class="quantity_wrapper">
                    <button class="less-plus-button" @click="decreaseQuantity(plate)"><i class="fas fa-minus-circle fa-lg fa-fw"></i></button>
                    <button class="less-plus-button" @click="increaseQuantity(plate)"><i class="fas fa-plus-circle fa-lg fa-fw"></i></button>
                </div>
            </div>

            <div class="delete_cart" v-if="!emptyCart">
                <button class="remove-cart-btn" @click="deleteCart()">
                    <i class="fas fa-trash-alt"></i> Svuota Carrello
                </button>
            </div>

            <div class="checkout">
                <h3><i class="fas fa-tags"></i><b>Total:</b> € <span id="total_price">{{getTotal()}}</span></h3>
                <a class="checkout-btn" :href="'/restaurant/'+restaurant_info.slug+'/checkout'" v-if="toCheckoutPage"><i class="fas fa-check"></i> Checkout</a>
            </div>
        </div>
        
    </div>
</template>

<script>
    import {eventBus} from '../app';
    export default {
        props: ["restaurant"],
        data(){
            return {
                restaurant_info: null,
                plates_bought: []
            }
        },
        created() {
            this.restaurant_info = JSON.parse( this.restaurant );
            // Listen for the event localStorageUpdated
            eventBus.$on('RestaurantLocalStorageUpdated', () => {
                this.checkLocalStorage();
            })
        },
        mounted() {
            this.checkLocalStorage()
        },
        computed: {
            toCheckoutPage() {
                return (this.getTotal() > 0) && ( window.location.pathname == "/restaurant/" + this.restaurant_info.slug );
            },
            emptyCart() {
                return this.plates_bought.length == 0;
            }
        },
        methods : {
            checkLocalStorage(){
                if (localStorage.getItem('plates_bought')) {
                    try {
                        this.plates_bought = JSON.parse(localStorage.getItem('plates_bought'));
                        this.sortPlatesBought();
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
            sortPlatesBought(){
                this.plates_bought.sort((a, b) => {
                    return a.id - b.id;
                })
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
                this.sortPlatesBought();
                const parsed = JSON.stringify(this.plates_bought);
                localStorage.setItem('plates_bought', parsed);
                // Emit the event localStorageUpdated through the eventBus
                eventBus.$emit('CartLocalStorageUpdated');
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
            },
            getTotal(){
                if (!this.plates_bought) return 0

                return this.plates_bought.reduce( (total, plate)=>{
                    const subtotal = total + (plate.price * plate.quantity)
                    return Math.round( subtotal * 100 ) / 100; // round to 2 decimals places
                }, 0);
            },
            deleteCart(){
                this.plates_bought.splice(0, this.plates_bought.length);
                this.savePlate();
            }
        }
    }
</script>