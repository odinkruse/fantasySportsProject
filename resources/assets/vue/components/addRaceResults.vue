<template>
    <div class="add-vue container">
        <div class="col-md-6 col-md-offset-3">
            <h3>Season Year</h3>
            <input v-model="formData.season" placeholder="2018 Season, 2017 Season">
            <h3>Third</h3>
            <input v-model="formData.third" placeholder="1,2 or 3">
            <h3>Race Name</h3>
            <input v-model="formData.raceName" placeholder="Daytona 500">
            <h3>Race Number</h3>
            <input v-model="formData.raceNumber" placeholder="1">
            <h3>Track</h3>
            <input v-model="formData.track" placeholder="Daytona">
            <h3>raceDate</h3>
            <input v-model="formData.raceDate" placeholder="2/22/2017">
            <h3>Results URL</h3>
            <input v-model="formData.url" placeholder="www.espn.com">
            <h3>Auth</h3>
            <input v-model="formData.auth" placeholder="dont mess this up">
            <div>
                <a @click="addUrl">Add</a>
            </div>
            <div>
                <a @click="updateThird">Update Third</a>
            </div>
            <div>
                <a @click="updateThird">Update Season</a>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            formData: {
                season:"2018",
                third:"1",
                url: "http://racing-reference.info/race/2017_Daytona_500/W",
                raceName:"Daytona 500",
                raceNumber:"1",
                track:"Daytona",
                raceDate:"02/26/2017",
                auth:""
            }
        }
    },
    methods:{
        addUrl(){
            for(let el in this.formData){
               if(el == "")
               {
                   alert(`Please fill in ${el.constructor.name}`);
                   return;
               }
            }
            console.log("addRaceResults");
            this.$http.post('/add-race-results', {formData:this.formData}).then(function(response){
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