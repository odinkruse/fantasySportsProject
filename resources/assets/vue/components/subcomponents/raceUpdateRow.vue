<template>
    <tr>
        <td>
            {{result.position}}
        </td>
        <td>
            {{result.number}}
        </td>
        <td>
            {{result.firstName}} {{result.lastName}}
        </td>
        <td>
            {{result.standardPoints}}
        </td>
        <td v-if="updateOpen">
            <input class="form-control" type="number" v-model="result.penalty">
        </td>
        <td v-else>
            {{result.penalty}}
        </td>
        <td v-if="updateOpen">
            <input class="form-control" type="number" v-model="result.points">
        </td>
        <td v-else>
            {{result.points}}
        </td>
        <td v-if="!updateOpen">
            <a @click="updateRace">Update</a>
        </td>
        <td v-else>
            <a @click="cancelUpdate">Cancel</a> / <a @click="commitUpdate">Commit</a>
        </td>
    </tr>
</template>

<script>
    export default {
        props:["result"],
        data() {
            return{
                updateOpen:false,
                initialPenalty:this.result.penalty,
                initialPoints:this.result.points
            }
        },
        methods:{
            updateRace(){
                this.updateOpen = true;
            },
            cancelUpdate(){
                this.updateOpen = false;
                this.result.penalty = this.initialPenalty;
                this.result.points = this.initialPoints;
            },
            commitUpdate(){
                const vue = this;
                this.$http.post('/update-race-results', {raceData:JSON.stringify(this.result)}).then(function(response) {
                    vue.updateOpen = false;
                    vue.result.penalty = response.data.raceData.penalty;
                    vue.result.points = response.data.raceData.points;
                    vue.initialPenalty = response.data.raceData.penalty;
                    vue.initialPoints = response.data.raceData.points;
                    console.log(response)
                });
            }
        }
    }
</script>

<style scoped>

</style>