<template>    
    <div class="parent">        
        <div class="block">   
            <div v-for="state in states" :key="state.index">
                <h1>{{state.name}}</h1> 
                <span v-html="state.text"></span>
                <span>Дата публикации:</span><span v-html="state.date_publish"></span>
                <span>Автор:</span><span v-html="state.author"></span>
            </div>       
        </div>        
    </div>
</template>
<script>    
    export default {
        name: 'app',
        data() {
            return {               
                states:[]
            };
        },
        async mounted() {
            await this.loadState();
        },
        methods:{
            async loadState(){                
                this.states = await axios
                .get(`/api/news`)
                .then((response) => response.data)
                .catch(function (error) {
                    return error.response;
                });        
                console.log(this.states)
            }
        }
    }
</script>
<style scoped>
.btn-save{
    margin-top: 10px !important;
}
.form-control{
    margin-bottom: 10px !important;
}
.form-control{
    margin-top: 10px !important;
}
.parent {
    width: 100%;    
    top: 0;
    left: 0;
    overflow: auto;
}

.block {   
    position: absolute;
    top: 20%;
    left: 50%;
    margin: -125px 0 0 -125px;    
}
</style>