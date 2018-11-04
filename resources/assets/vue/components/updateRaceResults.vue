<template>
    <div class="update-race-results-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h1>{{data.race.name}} {{data.race.raceDate}}</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Position
                            </th>
                            <th>
                                Car Number
                            </th>
                            <th>
                                Driver
                            </th>
                            <th>
                                Standard Points
                            </th>
                            <th>
                                Penalty
                            </th>
                            <th>
                                Total Points
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="result in raceData">
                            <row-component :result="result"></row-component>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import RowComponent from './subcomponents/raceUpdateRow';
    export default {
        components:{
            RowComponent,
            'row-component':RowComponent
        },
        props: ['data'],
        data() {
            return {
                raceData: this.data.raceResults
            }
        },
        methods:{
            commitUpdate(index){

            }
        }
    }
</script>

<style scoped>

</style>