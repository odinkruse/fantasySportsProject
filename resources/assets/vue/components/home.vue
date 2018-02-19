<template>
    <div class="home-vue">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h1>{{data.season.name}}</h1>
                <div>
                    Next Race: {{data.race.name}}
                    Race Number: {{data.race.raceNo}}
                </div>
                <table class="table">
                    <thead>
                        <h3>Standings</h3>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Team's</td>
                            <td v-for="team in data.seasonStandings">
                                {{team.teamNumber}}
                            </td>
                        </tr>
                        <tr>
                            <td>Season Points</td>
                            <td v-for="team in data.seasonStandings">
                                {{team.points}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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