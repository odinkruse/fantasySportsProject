<template>
        <tr :class="rowStyle">
            <td>{{rowData.name}}</td>
            <td>{{rowData.number}}</td>
            <td>{{rowData.firstName}} {{rowData.lastName}}</td>
            <td>{{rowData.wins}}</td>
            <td>{{rowData.points}}</td>
        </tr>
</template>
<script>
    export default {
        props:["rowData"],
        data() {
            return{
                
            }
        },
        computed:{
            rowStyle: function(){
                return{
                    out: this.rowData.out == 1
                }
            }
        }
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