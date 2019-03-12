<template>
    <div class="wes-bet-vue container">
        <div class="col-md-10 col-md-offset-1">
            <h1>Wes's Side Bet</h1>
            <table class="table">
                <thead>
                    <tr>
                        <td></td>
                        <td><h3>Car</h3></td>
                        <td><h3>Driver</h3></td>
                        <td><h3>Wins</h3></td>
                        <td><h3>Points</h3></td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="bet in data.betData">
                        <td>{{bet.name}}</td>
                        <td>{{bet.number}}</td>
                        <td>{{bet.firstName}} {{bet.lastName}}</td>
                        <td>{{bet.wins}}</td>
                        <td>{{bet.points}}</td>
                    </tr>
                </tbody>
            </table>
            <p class="useless">
                Greyed out numbers mean they are more or less useless because there isn't a duplicate pick.
            </p>
            <p class="out">
                Red rows mean the driver is out of playoff contention, or an opponent has already beaten you in the tiebreak.
            </p>
        </div>

    </div>
</template>

<script>
    export default {
        props:['data']
    }
</script>

<style scoped>
    .useless{
        color: #969EA2;
    }
    .out{
        color:red;
    }
    .winner{
        color:limegreen;
        font-size:16px;
    }
</style>