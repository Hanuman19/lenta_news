import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import User from './modules/user'
import createPersistedState from "vuex-persistedstate";


export default new Vuex.Store({   
    modules:{
        user:User        
    },
    plugins: [createPersistedState()]
});