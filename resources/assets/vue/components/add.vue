<template>
    <div class="add-vue">
        <h1>Race Name</h1>
        <input v-model="formData.raceName" placeholder="Daytona 500">
        <h1>Race Number</h1>
        <input v-model="formData.raceNumber" placeholder="1">
        <h1>Track</h1>
        <input v-model="formData.track" placeholder="Daytona">
        <h1>Laps</h1>
        <input v-model="formData.laps" placeholder="250">
        <h1>raceDate</h1>
        <input v-model="formData.raceDate" placeholder="2/22/2017">
        <h1>Results URL</h1>
        <input v-model="formData.url" placeholder="www.espn.com">
        <div>
            <a @click="addUrl">Add</a>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            formData: {
                url: "http://www.espn.com/racing/raceresults?raceId=201702260001&series=sprint",
                raceName:"Daytona 500",
                raceNumber:"1",
                track:"Daytona",
                laps:"250",
                raceDate:"2/22/2017"
            }
        }
    },
    methods:{
        addUrl(){
            for(var el in this.formData){
               if(el == "")
               {
                   alert(`Please fill in ${el.constructor.name}`);
                   return;
               }
            }
            console.log(this.formData);
            this.$http.post('/add-race', {formData:this.formData}).then(function(response){
               console.log(response);
            });
        }
    }
}
</script>
<style>

</style>