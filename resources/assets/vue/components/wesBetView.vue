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
                        <td><h3>Points</h3></td>
                        <td><h3>Wins</h3></td>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Jason</td>
                    <td>4</td>
                    <td>Kevin Harvick</td>
                    <td class="useless">1470</td>
                    <td class="useless">8</td>
                </tr>
                    <tr>
                        <td>Darrell</td>
                        <td>18</td>
                        <td>KY Busch</td>
                        <td>1422</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Wes</td>
                        <td>18</td>
                        <td>KY Busch</td>
                        <td>1326</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>Odin</td>
                        <td>22</td>
                        <td>Joey Logano</td>
                        <td class="useless">1350</td>
                        <td class="useless">5</td>
                    </tr>
                    <tr class="out">
                        <td>Bob</td>
                        <td>4</td>
                        <td>Kevin Harvick</td>
                        <td>1150</td>
                        <td>7</td>
                    </tr>
                    <tr class="out">
                        <td>Danny</td>
                        <td>2</td>
                        <td>Brad Keslowski</td>
                        <td>1399</td>
                        <td> - </td>
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
</style>