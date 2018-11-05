<template>
    <div class="add-race-vue container">
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <form>
                    <div class="form-group">
                        <label for="raceName">Race Name</label>
                        <input class="form-control" id="raceName" placeholder="Daytona 500" v-model="raceData.raceName">
                        <label for="raceNumber">Race Number</label>
                        <input class="form-control" id="raceNumber" placeholder="8" v-model="raceData.raceNumber">
                        <label for="raceDate">Race Date</label>
                        <input class="form-control" id="raceDate" placeholder="04/02/2018" v-model="raceData.raceDate">
                    </div>
                    <div class="form-group">
                        <label for="track">Track</label>
                        <select class="form-control" id="track" v-model="raceData.track">
                            <option v-for="track in data.tracks" :value="track">
                                {{track.name}}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="third">Third</label>
                        <select class="form-control" id="third" v-model="raceData.third">
                            <template v-for="third in data.thirds">
                                <option :value="third">
                                    {{third.name}}
                                </option>
                            </template>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="activeRace" v-model="raceData.active">
                        <label class="form-check-label" for="activeRace">Active Race</label>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <h3>New Race</h3>
                <p>{{raceData.raceName}}</p>
                <p>{{raceData.raceNumber}}</p>
                <p>{{raceData.raceDate}}</p>
                <p>{{raceData.track.name}}, ID {{raceData.track.id}}</p>
                <p>{{raceData.third.name}}, ID {{raceData.third.id}}</p>
                <p>{{raceData.active}}</p>
                <a class="btn btn-primary" v-show="valid" @click="createRace">
                    Create Race
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['data'],
        data(){
            return{
                raceData: {
                    raceName: "",
                    raceNumber: "",
                    raceDate: "",
                    track: this.data.tracks[0],
                    third: this.data.thirds[0],
                    active: false,
                }
            }
        },
        computed:{
            valid(){
                return this.raceData.raceName && this.raceData.raceNumber && this.raceData.raceDate;
            }
        },
        methods:{
            createRace(){
                this.$http.post('/add-race', {raceData:JSON.stringify(this.raceData)}).then(function(response) {
                    window.location.pathname="/";
                });
            }
        }
    }
</script>

<style scoped>

</style>