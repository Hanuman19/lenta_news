<template>    
    <div class="parent">        
        <div class="block">
            <div>
                <b-form-input                         
                        v-model="name" 
                        placeholder="Ведите название статьи" 
                        type="text"
                ></b-form-input> 
            </div>
           <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
           <div> 
                 <input
                    class="date-main"
                    type="date"
                    v-model="date" 
                  />               
            </div>
            <template v-if="btnSave==true">
                <div class="btn-save">
                    <b-button @click="save()" variant="primary">Сохранить</b-button>
                </div>
            </template>
             <template v-else>
                <div class="btn-save">
                    <b-form-group>                    
                        <b-button  @click="updateState()" variant="primary">Обновить</b-button>
                        <b-button @click="cancel()"  variant="primary">Отменить</b-button>
                    </b-form-group>
                </div>
            </template>
            <b-row>
                <p style="margin-top: 8px">Статьи:</p>
            </b-row>
            <b-row v-for="state in states" :key="state.index">
                <b-col md="1"><p style="margin-top: 8px">{{state.name}}</p></b-col>
                <b-col md="4" style="text-are:'left'">
                    <b-form-group>                    
                        <b-button @click="update(state)" variant="primary">Изменить</b-button>
                        <b-button @click="destroy(state)" variant="primary">Удалить</b-button>
                    </b-form-group>
                </b-col>
            </b-row>
        </div>        
    </div>
</template>
<script>
    import { DateTime, Duration, Info, Interval, Settings } from "luxon";
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';    
    export default {
        name: 'app',
        data() {
            return {
                id:null,
                btnSave:true,
                states:[],
                date: '',
                name: '',
                editor: ClassicEditor,
                editorData: '<p>Начните писать свою новость!</p>',
                editorConfig: {
                    cloudServices: {
                        tokenUrl: 'https://86685.cke-cs.com/token/dev/b434406dc262d4c92f5bf46fbfd2e7dc39e82078c236b1fd2b2a85f89a13?limit=10',
                        uploadUrl: 'https://86685.cke-cs.com/easyimage/upload/'
                    }
                },
                
            };
        },
        async mounted() {
            await this.loadState();
        },
        methods:{
            async destroy(state){
                let data = await axios
                .delete(`/api/news/${state.id}`)
                .then((response) => response.data)
                .catch(function (error) {
                    return error.response;
                }); 
                if(data.status==true){
                    await this.loadState();
                }       
                console.log(data)
            },
            async updateState(){
                let item={
                    "name":this.name,
                    "text":this.editorData,
                    "date_publish":this.date
                }
                console.log(item)
                let data = await axios
                .put(`/api/news/${this.id}`, item)
                .then((response) => response.data)
                .catch(function (error) {
                    return error.response;
                }); 
                if(data.status==true){
                    await this.loadState();
                }       
                console.log(data)
            },
            cancel(){
                this.btnSave=true                
                this.name=''
                this.editorData=''
                this.date=''
                this.id=null
            },
            update(state){
                this.btnSave=false
                this.name=state.name
                this.editorData=state.text
                state.date_publish = 
                    DateTime.fromSeconds(state.date_publish).toISO().split('T')[0]
                
                console.log(state.date_publish)
                this.date=state.date_publish
                this.id=state.id
            },
            async loadState(){                
                this.states = await axios
                .get(`/api/news_all`)
                .then((response) => response.data)
                .catch(function (error) {
                    return error.response;
                });        
                console.log(this.states)
            },
            async save(){
                let item={
                    "name":this.name,
                    "text":this.editorData,
                    "date_publish":this.date
                }
                console.log(item)
                let data = await axios
                .post(`/api/news`, item)
                .then((response) => response.data)
                .catch(function (error) {
                    return error.response;
                });        
                console.log(data)
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
    width: 70%; 
    position: absolute;
    top: 20%;
    left: 20%;
    margin: -125px 0 0 -125px;    
}
</style>