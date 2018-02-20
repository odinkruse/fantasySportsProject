<template>
<div class="latest-results-vue container">
    <div class="col-md-8 col-md-offset-3">
        <table>
            <thead>Results for {{data.race.name}}</thead>
            <tbody>
            <template v-for="Team in data.raceResultsByTeam">
                <tr>
                    <td>
                        Team {{Team.Team.number}} {{Team.Team.member1}}, {{Team.Team.member2}}
                    </td>

                </tr>
                <tr v-for="Results in Team.Results">
                    <td>Car ID: {{Results.car_id}}</td> <td>Points: {{Results.points}}</td>
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