<template>
    <div class="add-third-view" v-if="formData.teamArray && formData.teamArray.length">
        <div >
            <h1>Season</h1>
            <input v-model="formData.season">
            <h1>Third</h1>
            <input v-model="formData.third">
            <template v-for="(entry, teamIndex) in formData.teamArray">
                <div>
                    <h1>Team Number {{entry.team.teamNumber}}</h1>
                    <h1>{{entry.team.teamMember1}} & {{entry.team.teamMember2}}</h1>
                    <h3 class="inline">
                        Car Number
                    </h3>
                    <h3 class="inline">
                        $
                    </h3>
                </div>
                <div v-for="(car, count) in entry.pickArr">
                    <h3 class="inline">{{count+1}}</h3>
                    {{teamIndex}}
                    <input class="inline" v-model="formData.teamArray[teamIndex].pickArr[count].carNumber">
                    {{count}}
                    <input class="inline" v-model="formData.teamArray[teamIndex].pickArr[count].price">
                </div>
            </template>
        </div>
        <div>
            <a @click="addThird">Add</a>
        </div>
    </div>
</template>
<script>
    export default{
        props:['data'],
        data(){
            return{
                raceData:{
                    season:"",
                    third:"",
                    teamArray:[]
                }
            }
        },
        computed:{
        },
        methods:{
            addThird(){
                for(let entry in this.raceData.teamArray){
                    for(let input in entry.pickArr) {
                        if (input.carNumber == "" || input.price == "") {
                            alert(`Please fill in ${el.constructor.name}`);
                            return;
                        }
                    }
                }
                console.log(this.raceData);
                this.$http.post('/add-third', {formData:this.raceData}).then(function(response){
                    console.log(response);
                });
            }
        },
        created(){
            this.data.forEach(team=>{
                let defaultPickArr = [];
                for(let i = 0; i<5; i++){
                    defaultPickArr.push(
                        {
                            carNumber:`team ${team.teamNumber}`,
                            price:`car ${i+1}`
                        }
                    );
                }
                this.raceData.teamArray.push({
                    team,
                    pickArr:defaultPickArr
                });
            });
        },
        ready(){

        }
    }
</script>
<style>
.inline{
    display: inline-block;
}
</style>