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
                    <template v-for="row in data.betData">
                        <row-component :rowData="row"></row-component>
                    </template>
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
    import RowComponent from './subcomponents/wesBetRow';
    export default {
        components:{
            RowComponent,
            'row-component':RowComponent
        },
        props:['data']
    }
</script>

<style scoped>
</style>