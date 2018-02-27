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
                    <ul  class="nav nav-pills">
                        <li class="active">
                            <a data-toggle="tab" @click="toggleThird">Third Standings</a>
                        </li>
                        <li>
                            <a data-toggle="tab" @click="toggleSeason">Season Standings</a>
                        </li>
                    </ul>
                    <div :style="third">
                        <h3>Third Standings</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td v-for="team in data.thirdTeamStandings">
                                        {{team.member1}} & {{team.member2}}
                                    </td>
                                </tr>
                                <tr>
                                    <td v-for="team in data.thirdTeamStandings">
                                        {{team.points}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div :style="season">
                        <h3>Season Standings</h3>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td v-for="team in data.thirdTeamStandings">
                                    {{team.member1}} & {{team.member2}}
                                </td>
                            </tr>
                            <tr>
                                <td v-for="team in data.thirdTeamStandings">
                                    {{team.points}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
            third:{
                display:'block'
            },
            season:{
                display:'none'
            }
        }
    },
    methods:{
        toggleThird(){
            this.third.display = 'block';
            this.season.display = 'none';
        },
        toggleSeason(){
            this.third.display = 'none';
            this.season.display = 'block';
        }
    }
}
</script>
<style>

</style>