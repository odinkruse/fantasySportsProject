<template>
    <div class="add-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <form>
                    <div class="form-group">

                        <!--<input class="form-control" v-model="seasonData.year" placeholder="2018, 2017, 2016 etc etc">-->

                        <label for="season">Season</label>
                        <select class="form-control" id="season" v-model="seasonData.season">
                            <option v-for="season in data.seasons" :value="season">
                                {{season.name}}
                            </option>
                        </select>

                    </div>
                    <a class="btn btn-primary" @click="updateSeason">
                        Update Season
                    </a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['data'],
        data(){
            return {
                seasonData: {
                    season:this.data.seasons[0]
                }
            }
        },
        methods:{
            updateSeason(){
                for(let el in this.seasonData){
                    if(el == "")
                    {
                        alert(`Please fill in ${el.constructor.name}`);
                        return;
                    }
                }
                console.log("updateSeason");
                this.$http.post('/update-season-standings', {seasonData:JSON.stringify(this.seasonData)}).then(function(response){
                    console.log(response);
                });
            }
        }
    }
</script>

<style scoped>

</style>