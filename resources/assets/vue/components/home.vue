<template>
    <div class="home-vue">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <h1>{{data.season.name}}</h1>
                    <div>
                        <h3>Next Race - {{data.race.name}}</h3>
                        <h4>Race Number {{data.race.raceNo}}</h4>
                    </div>
                    <table class="table">
                        <thead>
                            <h3>Standings</h3>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Teams</td>
                                <td v-for="team in data.thirdTeamStandings">
                                    {{team.member1}} & {{team.member2}}
                                </td>
                            </tr>
                            <tr>
                                <td>Third Points</td>
                                <td v-for="team in data.thirdTeamStandings">
                                    {{team.points}}
                                </td>
                            </tr>
                            <tr>
                                <td>Season Points</td>
                                <td v-for="team in data.thirdTeamStandings">
                                    {{team.points}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <h3>Recent Race Results</h3>
                    <div v-for="race in data.recentRaceResults">
                        <a :href="'/team-results/race/'+race.id">
                            {{race.name}}
                        </a>
                    </div>
                </div>
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