<template>
    <div class="add-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <form>
                    <div class="form-group">
                        <!--<h3>Third</h3>-->
                        <label for="third">Third</label>
                        <select class="form-control" id="third" v-model="thirdData.third">
                            <option v-for="third in data.thirds" :value="third">
                                {{third.name}}
                            </option>
                        </select>
                    </div>
                    <a class="btn btn-primary" @click="updateThird">
                        Update Third
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
                thirdData: {
                    third:this.data.thirds[0]
                },
                seasonData: {
                    season:{}
                }
            }
        },
        methods:{
            updateThird(){
                for(let el in this.thirdData){
                    if(el == "")
                    {
                        alert(`Please fill in ${el.constructor.name}`);
                        return;
                    }
                }
                const vue = this;
                console.log("updateThird");
                this.$http.post('/update-third-standings', {thirdData:JSON.stringify(this.thirdData)}).then(function(response){
                    console.log(response);
                    vue.seasonData.season = response.data.season;
                    vue.updateSeason();

                });
            },
            updateSeason(){
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