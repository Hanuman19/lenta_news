<template>    
    <div class="parent">
        <div class="block">
            <b-card
                title="Регистрация"               
                tag="article"                
                class="mb-3"
            >
                <b-card-text>
                    <div>
                        <b-form-input                         
                        v-model="name" 
                        placeholder="Ведите логин" 
                        type="text"         
                        :state="nameState"
                        aria-describedby="input-name-help input-name-feedback"
                        trim                          
                        ></b-form-input>
                        <b-form-invalid-feedback id="input-name-feedback">
                            Пароль должен состоять минимум из 3 символов
                        </b-form-invalid-feedback>       
                    </div>
                    <div>
                        <b-form-input
                        v-model="pass" 
                        placeholder="Ведите пароль" 
                        type="password"
                        :state="passState"
                        aria-describedby="input-pass-help input-pass-feedback"
                        trim                          
                        ></b-form-input>
                        <b-form-invalid-feedback id="input-pass-feedback">
                            Пароль должен состоять минимум из 8 символов
                        </b-form-invalid-feedback>
                    </div>
                    <div>
                        <b-form-input
                        v-model="pass2" 
                        placeholder="Ведите пароль еще раз" 
                        type="password"
                        :state="pass2State"
                        aria-describedby="input-pass-help input-pass-feedback"
                        trim                        
                        ></b-form-input>
                        <b-form-invalid-feedback id="input-pass-feedback">
                            Пароли не совпадают
                        </b-form-invalid-feedback> 
                    </div>                         
                </b-card-text>
                <b-button @click="save()" variant="primary">Регистрация</b-button>
                <b-alert v-if="allert==true" show variant="success">Пользователь успешно создан</b-alert>
                <b-alert v-if="messages!==''" show variant="danger">{{messages}}</b-alert>
            </b-card>
        </div>
    </div>
</template>
<script>
  export default { 
      computed:{
        nameState() {
            if(this.name==null || this.name==''){
                return null
            }else{
                return this.name.length > 2 ? true : false 
            }  
        },
        pass2State() {  
            if(this.pass2 == null || this.pass2 == ''){
                return null
            }else{
                return this.pass2 == this.pass ? true : false
            }
        },
        passState() {  
            if(this.pass == null || this.pass == ''){
                return null
            }else{
                return  this.pass.length > 7 ? true : false
            }
        }
      },   
    data() {
      return {
        allert:false,
        name: '',
        pass: '',
        pass2: '',
        messages: ''
      }
    },
    methods:{
        async save(){
            let item={'name':this.name,'password': this.pass}
            let valid = this.formValidate();
            if(valid){
                let data = await axios
                .post(`/api/register`, item)
                .then((response) => response.data)
                .catch(function (error) {
                return error.response;
                });
                console.log(data)
                if (data.status == true) {                    
                    setTimeout(() => this.allert=true, 5000);
                }else{
                    setTimeout(() => this.messages=data.error, 5000);
                }
            }
            
        },
        formValidate(){
            if(this.passState == true && this.nameState == true && this.pass2State == true){
                return true
            }else{
                return false
            }
        }
    }
  }
</script>
<style scoped>
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
    width: 250px;
    height: 250px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -125px 0 0 -125px;    
}
</style>