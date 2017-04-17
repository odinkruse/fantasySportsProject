<template>
    <div class="add-vue">
        <h1>Enter URL</h1>
        <input v-model="url" placeholder="www.nascar.com">
        <a @click="addUrl">Add</a>
    </div>
</template>
<script>
export default{
    data(){
        return {
            url: ""
        }
    },
    methods:{
        addUrl(){
            this.$http.post('/add-race', {url:this.url}).then(function(response){
               console.log(response.data);
            });
        }
    }
}
</script>
<style>

</style>