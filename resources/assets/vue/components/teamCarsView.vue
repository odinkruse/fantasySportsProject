<template>
    <div class="team-cars-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div v-for="teamCarObj in data.teamCarList" class="row">
                <h2>Team {{teamCarObj.teamNumber}}</h2>
                <h3>{{teamCarObj.member1}} & {{teamCarObj.member2}}</h3>
                <table class="table">
                    <tbody>
                        <tr class="bold">
                            <td>
                                Car Number
                            </td>
                            <td>
                                Driver(s)
                            </td>
                        </tr>
                        <template v-for="car in teamCarObj.carList">
                            <tr>
                                <td>
                                    {{car.carNumber}}
                                </td>
                                <td v-for="driver in car.drivers">
                                    {{driver.firstName}} {{driver.lastName}} {{driver.suffix}}
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['data'],
        data(){
            return {
            }
        }
    }
</script>

<style>
    .bold{
        font-weight:bold;
    }
</style>