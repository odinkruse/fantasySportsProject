<template>
    <div class="season-index-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div v-for="season in data.seasons">
                <h3>
                    <a :href="'/season-standings/'+season.id">{{season.name}}</a>
                </h3>
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