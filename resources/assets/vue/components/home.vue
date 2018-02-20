<template>
    <div class="home-vue">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
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
                            <td>Teams</td>
                            <td v-for="team in data.seasonStandings">
                                {{team.teamNumber}}
                            </td>
                        </tr>
                        <tr>
                            <td>Season Points</td>
                            <td v-for="team in data.thirdTeamStandings">
                                {{team.points}}
                            </td>
                        </tr>
                        <tr>
                            <td>Third Points</td>
                            <td v-for="team in data.thirdTeamStandings">
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