<template>
<div class="latest-results-vue container">
    <div class="col-md-8 col-md-offset-3">
        <h3>Results for {{data.race.name}}</h3>
        <template v-for="TeamResults in data.raceResultsByTeam">
            <h2>
                Team {{TeamResults.Team.number}} - {{TeamResults.Team.member1}} & {{TeamResults.Team.member2}}
            </h2>
            <table class="table">
                <tbody>
                    <tr class="bold">
                        <td>Car</td>
                        <td>Driver</td>
                        <td>Points</td>
                    </tr>
                    <tr v-for="Results in TeamResults.Results">
                        <td>{{Results.carNumber}}</td>
                        <td>{{Results.driverName.firstName}} {{Results.driverName.lastName}}</td>
                        <td>{{Results.points}}</td>
                    </tr>
                    <tr class="bold">
                        <td>Total</td>
                        <td></td>
                        <td>{{TeamResults.TotalPoints}}</td>
                    </tr>
                </tbody>
            </table>
        </template>
    </div>
</div>
</template>
<script>
    export default{
        props:['data'],
        data(){
            return {
            }
        }
    }
</script>
<style>
.bold{
    font-weight:bold;
}
</style>