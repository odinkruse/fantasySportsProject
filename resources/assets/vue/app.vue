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
    //import UpdateThirdStandings from'./components/updateThirdStandings';
    //import UpdateSeasonStandings from'./components/updateSeasonStandings';
    import UpdateRaceResults from'./components/updateRaceResults';
    import RaceResultsView from './components/raceResultsView';
    import RaceResultsList from './components/raceResultsIndex';
    import AddThird from './components/addThird.vue';
    import ThirdStandingsIndex from './components/thirdStandingsIndex';
    import ThirdStandingsView from './components/thirdStandingsView';
    import SeasonStandingsIndex from './components/seasonStandingsIndex';
    import SeasonStandingsView from './components/seasonStandingsView';
    import TeamCars from './components/teamCarsView';
    import WesBet from './components/wesBetView';
    import AddRace from './components/addRaceView';
    import ShowTestRace from './components/showTestRace';
    import Header from'./global/header';
    import Footer from './global/footer';
    export default {
        components: {
            'header-component': Header,
            'footer-component': Footer,
            'home-view': Home,
            'add-race-results-view': AddRaceResults,
            //'update-third-standings-view':UpdateThirdStandings,
            //'update-season-standings-view':UpdateSeasonStandings,
            'update-race-results-view':UpdateRaceResults,
            'add-third-view': AddThird,
            'race-results-view': RaceResultsView,
            'race-results-index-view': RaceResultsList,
            'third-standings-index-view': ThirdStandingsIndex,
            'third-standings-view': ThirdStandingsView,
            'season-standings-index-view': SeasonStandingsIndex,
            'season-standings-view': SeasonStandingsView,
            'team-cars-view': TeamCars,
            'the-wes-bet-view':WesBet,
            'add-race-view': AddRace,
            //DEV
            'test-dump-view': TestDump,
            'show-test-race':ShowTestRace
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