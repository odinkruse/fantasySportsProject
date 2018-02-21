<template>
<div class="latest-results-vue container">
    <div class="col-md-8 col-md-offset-3">
        <table>
            <thead>Results for {{data.race.name}}</thead>
            <tbody>
            <template v-for="TeamResults in data.raceResultsByTeam">
                <tr>
                    <td>
                        Team {{TeamResults.Team.number}} - {{TeamResults.Team.member1}} & {{TeamResults.Team.member2}}
                    </td>
                </tr>
                <tr v-for="Results in TeamResults.Results">
                    <td>{{Results.carNumber}}</td>
                    <td>{{Results.driverName.firstName}} {{Results.driverName.lastName}}</td>
                    <td>{{Results.points}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{TeamResults.TotalPoints}}</td>
                </tr>
            </template>
            </tbody>
        </table>
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

</style>