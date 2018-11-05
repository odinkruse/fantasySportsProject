<template>
    <div class="show-race-test-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <form>
                    <div class="form-group">
                        <label for="resultsURL">ResultsURL</label>
                        <input class="form-control" id="resultsURL" v-model="url" placeholder="www.espn.com">
                    </div>
                    <a class="btn btn-primary" @click="addUrl">
                        Get Results
                    </a>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Position
                            </th>
                            <th>
                                Car
                            </th>
                            <th>
                                Driver
                            </th>
                            <th>
                                Points
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="result in resultArray">
                            <td>
                                {{result.position}}
                            </td>
                            <td>
                                {{result.car}}
                            </td>
                            <td>
                                {{result.driver}}
                            </td>
                            <td>
                                {{result.points}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    {{test1}}
                </div>
                <div>
                    {{test2}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: '',
                resultArray:[],
                test1:'',
                test2:'',
                data:{}
            }
        },
        methods:{
            addUrl(){
                const vue = this;
                this.$http.post('/get-test-race', {url:JSON.stringify(this.url)}).then(function(response) {
                    vue.data = response.data;
                    vue.resultArray = response.data.raceData.resultArray;
                    vue.test1 = response.data.raceData.test1;
                    vue.test2 = response.data.raceData.test2;
                    console.log(response);
                });
            }
        }
    }
</script>

<style scoped>

</style>