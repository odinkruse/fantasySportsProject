<template>
    <div class="third-standings-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h1>{{data.third.season.name}}</h1>
                <h2>Third {{data.third.thirdNo}}</h2>
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
                                    Total
                                </td>
                                <template v-for="n in 12">
                                    <td>R{{getRaceNo(n)}}</td>
                                </template>
                                <!--<td>R{{getRaceNo(1)}}</td><td>R{{getRaceNo(2)}}</td><td>R{{getRaceNo(3)}}</td><td>R{{getRaceNo(4)}}</td><td>R{{getRaceNo(5)}}</td><td>R{{getRaceNo(6)}}</td><td>R{{getRaceNo(7)}}</td><td>R{{getRaceNo(8)}}</td><td>R{{getRaceNo(9)}}</td><td>R{{getRaceNo(10)}}</td><td>R{{getRaceNo(11)}}</td><td>R{{getRaceNo(12)}}</td>-->
                            </tr>
                            <tr v-for="(teamStanding, index) in data.teamThirdStandings">
                                <td>{{index+1}}</td>
                                <td>
                                    <p>{{teamStanding.number}}</p>
                                </td>
                                <td>
                                    <p>{{parseFirstName(teamStanding.member1)}} & {{parseFirstName(teamStanding.member2)}}</p>
                                </td>
                                <td>
                                    {{teamStanding.third_points}}
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_1_points  > 0">
                                        {{teamStanding.race_1_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_2_points  > 0">
                                        {{teamStanding.race_2_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_3_points  > 0">
                                        {{teamStanding.race_3_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_4_points  > 0">
                                        {{teamStanding.race_4_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_5_points  > 0">
                                        {{teamStanding.race_5_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_6_points  > 0">
                                        {{teamStanding.race_6_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_7_points  > 0">
                                        {{teamStanding.race_7_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_8_points  > 0">
                                        {{teamStanding.race_8_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_9_points  > 0">
                                        {{teamStanding.race_9_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_10_points  > 0">
                                        {{teamStanding.race_10_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_11_points  > 0">
                                        {{teamStanding.race_11_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="teamStanding.race_12_points  > 0">
                                        {{teamStanding.race_12_points}}
                                    </template>
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
                                    Total
                                </td>
                                <td>R{{getRaceNo(1)}}</td><td>R{{getRaceNo(2)}}</td><td>R{{getRaceNo(3)}}</td><td>R{{getRaceNo(4)}}</td><td>R{{getRaceNo(5)}}</td><td>R{{getRaceNo(6)}}</td><td>R{{getRaceNo(7)}}</td><td>R{{getRaceNo(8)}}</td><td>R{{getRaceNo(9)}}</td><td>R{{getRaceNo(10)}}</td><td>R{{getRaceNo(11)}}</td><td>R{{getRaceNo(12)}}</td>
                            </tr>
                            <tr v-for="(carStanding, index) in data.carThirdStandings">
                                <td>{{index+1}}</td>
                                <td>
                                    <p>{{carStanding.number}}</p>
                                </td>
                                <td>
                                    <p v-for="driver in carStanding.drivers">{{driver.firstName}} {{driver.lastName}} {{driver.suffix}}</p>
                                </td>
                                <td>
                                    {{carStanding.third_points}}
                                </td>
                                <td>
                                    <template v-if="carStanding.race_1_points  > 0">
                                        {{carStanding.race_1_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_2_points  > 0">
                                        {{carStanding.race_2_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_3_points  > 0">
                                        {{carStanding.race_3_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_4_points  > 0">
                                        {{carStanding.race_4_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_5_points  > 0">
                                        {{carStanding.race_5_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_6_points  > 0">
                                        {{carStanding.race_6_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_7_points  > 0">
                                        {{carStanding.race_7_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_8_points  > 0">
                                        {{carStanding.race_8_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_9_points  > 0">
                                        {{carStanding.race_9_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_10_points  > 0">
                                        {{carStanding.race_10_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_11_points  > 0">
                                        {{carStanding.race_11_points}}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="carStanding.race_12_points  > 0">
                                        {{carStanding.race_12_points}}
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div  class="col-xs-6">
                    <template v-if="data.lastThird != null">
                        <div class="row">
                            <span class="return bold">Last</span>
                            <a :href="'/third-standings/'+data.lastThird.id">{{data.lastThird.name}}</a>
                        </div>
                    </template>
                </div>
                <div class="col-xs-6 text-right">
                    <template v-if="data.nextThird != null">
                        <div class="row">
                            <span class="return bold">Next</span>
                            <a :href="'/third-standings/'+data.nextThird.id">{{data.nextThird.name}}</a>
                        </div>
                    </template>
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
            },
            getRaceNo(in_RaceNo)
            {
                return in_RaceNo + ((this.data.third.thirdNo - 1)*12);
            }
        }
    }
</script>

<style scoped>
    .bold{
        font-weight:bold;
    }
    .return:after {
        content: '\A';
        white-space: pre;
    }
</style>