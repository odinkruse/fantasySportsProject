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
    //DEV
    import TestDump from './components/testDumpView.vue';
    //Live
    import Home from './components/home.vue';
    import AddRaceResults from './components/addRaceResults.vue';
    import TeamRaceResults from './components/teamRaceResults.vue';
    import AddThird from './components/addThird.vue';
    import TeamCars from './components/teamCars';
    import Header from'./global/header.vue';
    import Footer from './global/footer.vue';
    export default {
        components: {
            'header-component': Header,
            'footer-component': Footer,
            'home-view': Home,
            'add-race-results-view': AddRaceResults,
            'add-third-view': AddThird,
            'team-race-results-view': TeamRaceResults,
            'team-cars-view': TeamCars,
            //DEV
            'test-dump-view': TestDump
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