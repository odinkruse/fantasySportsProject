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
    import TestDump from './components/testDumpView';
    //Live
    import Home from './components/home';
    import AddRaceResults from './components/addRaceResults';
    import UpdateThirdStandings from'./components/updateThirdStandings';
    import TeamRaceResults from './components/teamRaceResults';
    import RaceResultsList from './components/raceResultsIndex';
    import AddThird from './components/addThird.vue';
    import ThirdStandings from './components/thirdStandingsIndex';
    import TeamCars from './components/teamCars';
    import Header from'./global/header';
    import Footer from './global/footer';
    export default {
        components: {
            'header-component': Header,
            'footer-component': Footer,
            'home-view': Home,
            'add-race-results-view': AddRaceResults,
            'update-third-standings-view':UpdateThirdStandings,
            'add-third-view': AddThird,
            'team-race-results-view': TeamRaceResults,
            'race-results-list-view': RaceResultsList,
            'third-standings-index-view': ThirdStandings,
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