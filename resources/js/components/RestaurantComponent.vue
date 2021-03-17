<template>
    <div class="container">
     
        
    </div>
</template>

<script>
    export default {
        data(){
            return {
               plates:[]
            }
        },
        methods: {
            loadPlates() {
                axios.get('api/typologies')
                    .then(response => {
                        this.plates = response.data.data
                    })
                    .catch(error => console.log(error))
            }
        },
        mounted() {
            this.loadPlates();    
        }
    }
</script>
