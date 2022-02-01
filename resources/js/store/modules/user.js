export default{
    namespaced: true,
    state : {
        user: [],        
        protect:{
            status:null,
            error_login:false,
            message:null
        }
    },
    getters: {        
        gettersUsers(state){
            return state.user
        },
        getterProtect(state){
            return state.protect
        }
    },
    actions: {  
        async logoutUser(context){
            await  axios.get('/api/logout')
            .then((response) => response.data)
            .catch(function(error) {         
              return error.response  
            })
            let data = {
                status:null,
                error_login:false,
                message:null
            }
            await context.commit('auth_protect',data);
            await context.commit('auth_user', []);                       
        },      
        async loginUser(context,data){
            axios.get('/sanctum/csrf-cookie').then(response => {
                     // Login...
             });            
            let protect = await axios.post('/api/login', data)
            .then((response) => response.data)
            .catch(function(error) {         
              return error.response  
            })  
            console.log('Ответ от сервера:',protect)     
            if (protect['status']==true){
                let data={
                    status:protect['status'],
                    message:null,
                    error_login: false
                }
                await context.commit('auth_protect', data);
                await context.commit('auth_user', protect['user']);                            
            }else if (protect['status']==false){ 
                let data={
                    status:protect['status'],
                    message:'Данный пользователь не обнаружен, не активен, или Вы забыли пароль, обратитесь к Администратору',
                    error_login: true
                }
                await context.commit('auth_protect', data);
                await context.commit('auth_user', []);                
            }else{
                let data={
                    status:protect['status'],
                    message:'Не правильно введен логин или пароль',
                    error_login: true
                }
                await context.commit('auth_protect', data); 
                await context.commit('auth_user', []);
            }        
          },
    },
    mutations: {      
        auth_user(state,user){
            state.user = user
        },
        auth_protect(state,protect){
            state.protect['status']=protect['status']
            state.protect['message']=protect['message']
            state.protect['error_login']=protect['error_login']
        }
    }
}