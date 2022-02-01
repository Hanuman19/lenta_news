<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand">Тест</router-link>
            <template v-if="user.name == undefined">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">                
                        <li class="nav-item">
                            <router-link to="/login" class="nav-link">Вход</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/register" class="nav-link">Регистрация</router-link>
                        </li>                
                    </ul>
                </div>
            </template>
            <template v-else>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav"> 
                        <li class="nav-item">
                            <router-link to="/admin" class="nav-link">Админка</router-link>
                        </li>   
                        <li class="nav-item">
                            <b-button @click="logout()" type="text" variant="primary">Выход</b-button>                           
                        </li>             
                    </ul>
                </div>
            </template>
        </div>
    </nav>
</template>
<script>
import { mapGetters, mapActions } from 'vuex' // Подключаем хелпер
export default{
    computed: { 
      ...mapGetters({
        user: 'user/gettersUsers',        
        protect: 'user/getterProtect'
      })   
    },
     mounted() {
        console.log(this.user)
        // this.loginUser(this.test)
    },
    methods:{
        async logout(){
            await this.logoutUser()                        
        },
        ...mapActions({
            logoutUser: 'user/logoutUser' // Модуль/экшен
        })
    }
}
</script>

<style scoped>
.navbar{
    position: absolute !important;
}
</style>