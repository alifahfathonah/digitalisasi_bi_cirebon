import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        User:[],
        Department:[],
    },
    mutations: {
        getUser(state) {
            axios.get(BASE_URL + '/AksiUser/create').then(r => {
                state.User = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getDepartment(state) {
            axios.get(BASE_URL + '/AksiDepartment/create').then(r => {
                state.Department = r.data
            }).catch(e => {
                console.log(e);
            })
        },

    }
})
