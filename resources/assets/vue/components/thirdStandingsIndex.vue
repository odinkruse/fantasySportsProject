<template>
    <div class="third-index-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div v-for="season in data.seasons">
                <h3>
                    {{season.name}}
                </h3>
                <ul>
                    <li v-for="third in season.thirds">
                        <a :href="'/third-standings/'+third.id">{{third.name}}</a>
                    </li>
                </ul>
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