<template>
    <div class="team-results-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h2>Results for {{data.race.name}}</h2>
                <div>
                    <ul  class="nav nav-pills">
                        <li class="active">
                            <a data-toggle="tab" @click="toggleTeam">Team Results</a>
                        </li>
                        <li>
                            <a data-toggle="tab" @click="toggleCar">Car Results</a>
                        </li>
                    </ul>
                </div>
                <div :style="team">
                    <template v-for="TeamResults in data.raceResultsByTeam">
                        <h3>
                            Team {{TeamResults.Team.number}} - {{TeamResults.Team.member1}} & {{TeamResults.Team.member2}}
                        </h3>
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

                                    <td v-if="Results.penalty == 0">{{Results.points}}</td>
                                    <td v-else-if="Results.penalty > 0" style="color:red;">{{Results.points - Results.penalty}}</td>
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
                <div :style="car">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>
                                        Pos.
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Car
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Driver
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Std Pts
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Stage Pts
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Total Pts
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Penalty
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Team
                                    </strong>
                                </td>
                            </tr>
                            <tr v-for="CarResults in data.raceResultsByCar">
                                <td>
                                    {{CarResults.position}}
                                </td>
                                <td>
                                    {{CarResults.carNumber}}
                                </td>
                                <td>
                                    {{CarResults.driver}}
                                </td>
                                <td>

                                    {{CarResults.standardPoints}}
                                </td>
                                <td>
                                    <template v-if="CarResults.points > 0">
                                        {{CarResults.points - CarResults.standardPoints}}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td>
                                    <template v-if="CarResults.points > 0">
                                        {{CarResults.points}}
                                    </template>
                                    <template v-else>
                                        {{CarResults.standardPoints}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="CarResults.penalty == 0"></template>
                                    <template v-else-if="CarResults.penalty > 0" style="color:red;">{{CarResults.penalty}}</template>
                                </td>
                                <td>
                                    {{CarResults.team}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                team:{
                    display:'block'
                },
                car:{
                    display:'none'
                }
            }
        },
        methods:{
            toggleTeam(){
                this.team.display = 'block';
                this.car.display = 'none';
            },
            toggleCar(){
                this.team.display = 'none';
                this.car.display = 'block';
            }
        }
    }
</script>
<style>
.bold{
    font-weight:bold;
}
</style>