<template>
    <div class="add-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <form>
                    <div class="form-group">
                        <h3>Season Year</h3>
                        <input class="form-control" v-model="raceData.season" placeholder="2018 Season, 2017 Season">
                        <h3>Third</h3>
                        <input class="form-control" v-model="raceData.third" placeholder="1,2 or 3">
                        <h3>Race Name</h3>
                        <input class="form-control" v-model="raceData.raceName" placeholder="Daytona 500">
                        <h3>Race Number</h3>
                        <input class="form-control" v-model="raceData.raceNumber" placeholder="1">
                        <h3>Track</h3>
                        <input class="form-control" v-model="raceData.track" placeholder="Daytona">
                        <h3>raceDate</h3>
                        <input class="form-control" v-model="raceData.raceDate" placeholder="2/22/2017">
                        <h3>Results URL</h3>
                        <input class="form-control" v-model="raceData.url" placeholder="www.espn.com">
                        <h3>Auth</h3>
                        <input class="form-control" v-model="raceData.auth" placeholder="dont mess this up">
                    </div>
                    <a class="btn btn-primary" @click="addUrl">
                        Add
                    </a>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            raceData: {
                season:"",
                third:"",
                url: "",
                raceName:"",
                raceNumber:"",
                track:"",
                raceDate:"",
                auth:""
            }
        }
    },
    methods:{
        addUrl(){
            for(let el in this.raceData){
               if(el == "")
               {
                   alert(`Please fill in ${el.constructor.name}`);
                   return;
               }
            }
            console.log("addRaceResults");
            this.$http.post('/add-race-results', {raceData:this.raceData}).then(function(response){
               console.log(response);
               //this.updateThird();
            });
        },
        updateThird(){
            console.log("updateThird");
            this.$http.post('/update-third-standings').then(function(response){
                console.log(response);
            });
        }
    }
}
</script>
<style>

</style>