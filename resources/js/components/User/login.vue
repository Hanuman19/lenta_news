<template>    
    <div class="parent">
        <div class="block">
            <b-card
                title="Вход"               
                tag="article"
                style="max-width: 30rem;"
                class="mb-3"
            >
                <b-card-text>
                    <div>
                        <b-form-input 
                        id="input-name" 
                        v-model="name" 
                        placeholder="Ведите логин" 
                        type="text" 
                        :state="nameState"
                        aria-describedby="input-name-help input-name-feedback"
                        trim
                        ></b-form-input> 
                        <b-form-invalid-feedback id="input-name-feedback">
                            Логин должен состоять минимум из 3-х символов
                        </b-form-invalid-feedback>                       
                    </div>
                    <div>
                        <b-form-input 
                        id="input-pass" 
                        v-model="pass" 
                        placeholder="Ведите пароль" 
                        type="password" 
                        :state="passState"
                        aria-describedby="input-pass-help input-pass-feedback"
                        trim
                        ></b-form-input> 
                        <b-form-invalid-feedback id="input-pass-feedback">
                            Введите пароль
                        </b-form-invalid-feedback> 
                    </div>                    
                </b-card-text>

                <b-button @click="login()" variant="primary">Войти</b-button>
            </b-card>
        </div>
    </div>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
  export default {
    computed: {
      ...mapGetters({
        user: 'user/gettersUsers',       
        protect: 'user/getterProtect'
      }),
      nameState() {
          if(this.name==null || this.name==''){
              return null
          }else{
              return this.name.length > 2 ? true : false 
          }
               
      },
      passState() {       
        return this.pass.length > 0 ? true : false
      }
    },
    data() {
      return {
        name: '',
        pass: ''
      }
    },
    methods:{
      async login(){
        let data = {
          name: this.name,
          password: this.pass
        }
        //console.log(data)
        await this.loginUser(data)
        if(this.protect['status']==true){ 
          this.error_login=this.protect['error_login']
          this.message=null
          document.location.href = '/'          
        }else{
          this.error_login=this.protect['error_login']
          this.message=this.protect['message']
        }
      },           
      ...mapActions({
        loginUser: 'user/loginUser' // Модуль/экшен
      })
    },
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