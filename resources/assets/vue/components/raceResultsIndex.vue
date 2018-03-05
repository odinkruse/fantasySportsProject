<template>
    <div class="race-results-index-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div v-for="season in data.seasons" class="row">
                <h3>{{season.name}}</h3>
                <div class="col-xs-10 col-lg-offset-1">
                    <div v-for="race in season.races">
                        <a :href="'/team-results/race/'+race.id">
                            {{race.name}}
                        </a>
                    </div>
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
            }
        }
    }
</script>

<style scoped>

</style>