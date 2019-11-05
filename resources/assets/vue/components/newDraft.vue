<template>
    <div>
        <div>
            <h1>New Draft</h1>
        </div>
        <div>
            <!-- add a dropdown for current season and a button to add a new season -->
            <h1>Season</h1>
        </div>
        <div>
            <!-- A new third will be created every time there's a draft, add inputs for a new third -->
            <h1>
                Third
            </h1>
        </div>
        <!-- iterate through all the teams and make a form for each of them -->
        <div v-for:"team in data.teams">
            <h2>{{team.name}}</h2>
            <form>
                <div class="form-group">
                    <table>
                        <tr>
                            <td></td>
                            <td>Car</td>
                            <td>Driver</td>
                            <td>Price</td>
                            <td>Pick No</td>
                        </tr>
                        <row-component></row-component>
                        <row-component></row-component>
                        <row-component></row-component>
                        <row-component></row-component>
                    </table>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

export default {
    components:{
        RowComponent,
        'row-component':RowComponent
    },
    props:['data'],
    data(){
        return {
        }
    }
}
</script>
<style>

</style>


