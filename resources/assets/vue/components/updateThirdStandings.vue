<template>
    <div class="add-vue container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <form>
                    <div class="form-group">
                        <h3>Season Year</h3>
                        <input class="form-control" v-model="thirdData.year" placeholder="2018, 2017, 2016 etc etc">
                        <h3>Third</h3>
                        <input class="form-control" v-model="thirdData.third" placeholder="1,2 or 3">
                        <h3>Auth</h3>
                        <input class="form-control" v-model="thirdData.auth" placeholder="dont mess this up">
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
        data(){
            return {
                thirdData: {
                    year:"",
                    third:"",
                    auth:""
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
                console.log("updateThird");
                this.$http.post('/update-third-standings', {thirdData:this.thirdData}).then(function(response){
                    console.log(response);

                });
            }
        }
    }
</script>

<style scoped>

</style>