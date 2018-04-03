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
    import Home from './components/homeView';
    import AddRaceResults from './components/addRaceResults';
    import UpdateThirdStandings from'./components/updateThirdStandings';
    import RaceResultsView from './components/raceResultsView';
    import RaceResultsList from './components/raceResultsIndex';
    import AddThird from './components/addThird.vue';
    import ThirdStandingsIndex from './components/thirdStandingsIndex';
    import ThirdStandingsView from './components/thirdStandingsView';
    import TeamCars from './components/teamCarsView';
    import WesBet from './components/wesBetView';
    import AddRace from './components/addRaceView';
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
            'race-results-view': RaceResultsView,
            'race-results-index-view': RaceResultsList,
            'third-standings-index-view': ThirdStandingsIndex,
            'third-standings-view': ThirdStandingsView,
            'team-cars-view': TeamCars,
            'the-wes-bet-view':WesBet,
            'add-race-view': AddRace,
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