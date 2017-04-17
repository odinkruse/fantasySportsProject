<template>
    <div class="vue-app">
        <header-component></header-component>
        <!--<h1>Fantasy Nascar {{view}} page</h1>-->
        <!--<h2>{{ obj.year }} Season Standings</h2>-->
        <component
            :is="view"
            :data="data"
            >
        </component>
        <footer-component></footer-component>
    </div>
</template>
<script>
    import Home from './components/home.vue';
    import Add from './components/add.vue';
    import Header from'./global/header.vue';
    import Footer from './global/footer.vue';
    export default {
        components: {
            'header-component': Header,
            'footer-component': Footer,
            'home-view': Home,
            'add-race-view': Add
        },
        props:['json','view'],
        created(){
          console.log("created");
          console.log(this.data);
        },
        data() {
            return {
                data: this.json ? JSON.parse(this.json) : {}
            };
        },
        ready(){
            console.log("data");
            console.log(this.data);
        }
//        data(){
//            return{
//                data
//            }
//        }
    };
</script>
<style>

</style>