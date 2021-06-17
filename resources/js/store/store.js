import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        veiculos: [],
        veiculo_id: ''
    },
    getters: {
        getVeiculos: state => {
            return state.veiculos;
        },

        getVeiculoId: state => {
            return state.veiculo_id;
        }
    },
    actions: {
        veiculos({commit}, payload) {
            commit('setVeiculos', payload)
        },

        veiculoId({commit}, payload) {
            commit('setVeiculoId', payload)
        }
    },
    mutations: {
        setVeiculos(state, payload) {
            state.veiculos = payload
        },

        setVeiculoId(state, payload) {
            state.veiculo_id = payload
        }
    },
    
})