<template>
    <div class="add-vue container">
        <div class="col-md-6 col-md-offset-3">
            <h1>Race Name</h1>
            <input v-model="formData.raceName" placeholder="Daytona 500">
            <h1>Race Number</h1>
            <input v-model="formData.raceNumber" placeholder="1">
            <h1>Track</h1>
            <input v-model="formData.track" placeholder="Daytona">
            <h1>raceDate</h1>
            <input v-model="formData.raceDate" placeholder="2/22/2017">
            <h1>Results URL</h1>
            <input v-model="formData.url" placeholder="www.espn.com">
            <div>
                <a @click="addUrl">Add</a>
            </div>
            <div>
                <a @click="updateThird">Update Third</a>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            formData: {
                url: "http://racing-reference.info/race/2018_Daytona_500/W",
                raceName:"Daytona 500",
                raceNumber:"1",
                track:"Daytona",
                raceDate:"2/18/2018"
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