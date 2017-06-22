<template>
    <div>
        <h1>Vue works in WordPress!</h1>
        <ul>
            <li v-for="example in examples">{{ example.name }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name : "App",
        data : () => {
            return {
                examples : [], //Some data that we will set from the server.
            };
        },
        methods : {
            //Gets examples from the server and sets to component's data.
            getExamples : function () {
                //Options for request.
                let options = {
                    params : {
                        action: 'mwd_example'
                    }
                };
                //We need a way to reference this component inside closure.
                let vm = this;
                //Perform request...
                this.$http.get(ajaxurl, options).then(response => {
                    //Set data to component from reponse.
                    vm.examples = response.data;
                }, response => {
                    //Whoops...
                    alert('Could not get examples from server!');
                });
            }
        },
        mounted : function () {
            //Run this method when component is mounted.
            this.getExamples();
        }
    }
</script>

<style lang="scss">

</style>
