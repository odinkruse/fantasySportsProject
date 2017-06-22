<template>
    <div class="home-vue">
        <h1>Coming from the Home View</h1>
        <div v-for="race in data.races">
            {{race.raceNo}}
            {{race.name}}
            {{race.track}}
            {{race.laps}}
            {{race.raceDate}}
        </div>
        <div v-for="team in data.teams">
            {{team.teamNumber}}
            {{team.teamMember1}}
            {{team.teamMember2}}
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