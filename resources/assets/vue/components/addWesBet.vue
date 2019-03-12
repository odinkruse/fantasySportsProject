<template>
    <div class="add-wes-bet-vue container">
        <div class="col-md-10 col-md-offset-1">
            <h1>Add Bet</h1>
            <form>
                <div class="form-group">
                    <label for="season">Season</label>
                    <select class="form-control" id="season" v-model="bet.season">
                        <option v-for="season in data.seasons" :value="season.id">
                            {{season.year}}
                        </option>
                    </select>
                    <label for="better">Better</label>
                    <input class="form-control" id="better" placeholder="John Doe" v-model="bet.better">
                    <label for="car">Car Number</label>
                    <select class="form-control" id="car" v-model="bet.car">
                        <option v-for="car in data.cars" :value="car.id">
                            {{car.number}}
                        </option>
                    </select>
                    <label for="wins">Win Count</label>
                    <input class="form-control" id="wins" v-model="bet.wins">
                    <label for="points">Point Total</label>
                    <input class="form-control" id="points" v-model="bet.points">
                </div>
            </form>
            <a class="btn btn-primary" @click="createBet">
                Create Bet
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props:['data'],
        data(){
            return {
                bet:{
                    season:null,
                    better:"",
                    car:null,
                    wins:null,
                    points:null,
                }
            }
        },
        methods:{
            createBet(){
                this.$http.post('/add-wes-bet', {bet:JSON.stringify(this.bet)}).then(function(response) {
                    console.log(response);
                    window.location.pathname="/add-wes-bet";
                });
            },
            getCars(){
                this.$http.get('').then(function(response){
                    this.list = response.data;
                }, function(error){
                    console.log(error.statusText);
                });
            }
        }
    }
</script>

<style scoped>

</style>