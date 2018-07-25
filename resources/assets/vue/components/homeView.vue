<template>
    <div class="home-vue">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <h1>{{data.season.name}}</h1>
                    <div>
                        <h3>Next Race</h3>
                        <h2>Race {{data.race.raceNo}}, {{data.race.name}}<br>
                            {{data.track.name}}
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <ul  class="nav nav-pills">
                        <li class="active">
                            <a data-toggle="tab" @click="toggleThird">Third Points</a>
                        </li>
                        <li>
                            <a data-toggle="tab" @click="toggleSeason">Season Points</a>
                        </li>
                    </ul>
                    <div :style="third">
                        <h3>Third Points</h3>
                        <table class="table">
                            <tbody class="text-center">
                                <tr>
                                    <td v-for="team in data.teamStandings">
                                        <h3>{{team.teamNumber}}</h3>
                                        <p>{{team.member1}} & {{team.member2}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td v-for="team in data.teamStandings">
                                        <h3>{{team.thirdPoints}}</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div :style="season">
                        <h3>Season Points</h3>
                        <table class="table">
                            <tbody class="text-center">
                            <tr>
                                <td v-for="team in data.teamStandings">
                                    <h3>{{team.teamNumber}}</h3>
                                    <p>{{team.member1}} & {{team.member2}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td v-for="team in data.teamStandings">
                                    <h3>{{team.seasonPoints}}</h3>
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
    .row{
        padding: 15px 0;
    }
</style>