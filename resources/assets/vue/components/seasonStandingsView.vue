<template>
    <div class="season-standings-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h1>{{data.season.name}}</h1>
                <div>
                    <ul  class="nav nav-pills">
                        <li class="active">
                            <a data-toggle="tab" @click="toggleTeam">Team Standings</a>
                        </li>
                        <li>
                            <a data-toggle="tab" @click="toggleCar">Car Standings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div :style="team">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    Position
                                </td>
                                <td>
                                    Team
                                </td>
                                <td>
                                </td>
                                <td>
                                    Points
                                </td>
                            </tr>
                            <tr v-for="(teamStanding, index) in data.teamSeasonStandings">
                                <td>{{index+1}}</td>
                                <td>
                                    <p>{{teamStanding.number}}</p>
                                </td>
                                <td>
                                    <p>{{parseFirstName(teamStanding.member1)}} & {{parseFirstName(teamStanding.member2)}}</p>
                                </td>
                                <td>
                                    {{teamStanding.points}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div :style="car">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    Position
                                </td>
                                <td>
                                    Car
                                </td>
                                <td>
                                    Driver(s)
                                </td>
                                <td>
                                    Points
                                </td>
                            </tr>
                            <tr v-for="(carStanding, index) in data.carSeasonStandings">
                                <td>{{index+1}}</td>
                                <td>
                                    <p>{{carStanding.number}}</p>
                                </td>
                                <td>
                                    <p v-for="driver in carStanding.drivers">{{driver.firstName}} {{driver.lastName}} {{driver.suffix}}</p>
                                </td>
                                <td>
                                    {{carStanding.points}}
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
        computed:{
        },
        methods:{
            parseFirstName(name){
                return name.split(' ')[0];
            },
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

<style scoped>

</style>