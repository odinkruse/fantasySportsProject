<template>
    <div class="test-dump-vue container">
        {{data.dump1}}
        {{data.dump2}}
        {{data.dump3}}
    </div>
</template>

<script>
    export default {
        name: "test-dump",
        props:['data'],
        data(){
            return {
            }
        }
    }
</script>

<style scoped>

</style>