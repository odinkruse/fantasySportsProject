<template>
    <div class="add-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <form>
                    <div class="form-group">
                        <label for="race">Race</label>
                        <select class="form-control" id="race" v-model="raceData.race">
                            <option v-for="race in data.races" :value="race">
                                {{race.name}}
                            </option>
                        </select>
                        <label for="resultsURL">ResultsURL</label>
                        <input class="form-control" id="resultsURL" v-model="raceData.url" placeholder="www.espn.com">
                    </div>
                    <a class="btn btn-primary" @click="addUrl">
                        Add Results
                    </a>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:['data'],
    data(){
        return {
            raceData: {
                race:this.data.races[0],
                url: ""
            },
            thirdData:{
                third:{}
            },
            seasonData:{
                season:{}
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
            const vue = this;
            console.log("addRaceResults");
            this.$http.post('/add-race-results', {raceData:JSON.stringify(this.raceData)}).then(function(response){
                window.location.pathname="/";
            });
        }
        // updateThird(){
        //     const vue = this;
        //     console.log("updateThird");
        //     this.$http.post('/update-third-standings', {thirdData:JSON.stringify(this.thirdData)}).then(function(response){
        //         console.log(response);
        //         vue.seasonData.season = response.data.season;
        //         vue.updateSeason();
        //
        //     });
        // },
        // updateSeason(){
        //     console.log("updateSeason");
        //     this.$http.post('/update-season-standings', {seasonData:JSON.stringify(this.seasonData)}).then(function(response){
        //         console.log(response);
        //     });
        //}
    }
}
</script>
<style>

</style>