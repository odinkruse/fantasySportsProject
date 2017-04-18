<template>
    <div class="home-vue">
        <h1>Coming from the Home View</h1>
        <div>
            {{data.data[0].raceNo}}
            {{data.data[0].name}}
            {{data.data[0].track}}
            {{data.data[0].laps}}
            {{data.data[0].raceDate}}
        </div>
    </div>
</template>
<script>
export default{
    props:['data'],
    data(){
        return {
        }
    }
}
</script>
<style>

</style>