import Vue from 'vue'
import Vuex from 'vuex'
import * as types from './mutation-types'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

// initial state
const state = {
    added: [],
    all: [
        {
            id: "1",
            name: "Meeracle Gemstone Serum",
            description: "",
            price: 399
        },
        {
            id: "2",
            name: "Meeracle Gemstone Cleanser",
            description: "",
            price: 399
        }
    ]
};

// getters
const getters = {
    allProducts: state => state.all, // would need action/mutation if data fetched async
    getNumberOfProducts: state => (state.all) ? state.all.length : 0,
    cartProducts: state => {
        return state.added.map(({ id, serial, quantity }) => {
            const product = state.all.find(p => p.id === id)
            console.log('product',product, id);
            return {
                product,
                serial,
                quantity
            }
        })
    }
}

// actions
const actions = {
    addToCart({ commit }, product) {
        console.log("added", product);
        commit(types.ADD_TO_CART, {
            id: product.id,
            serial: product.serial
        });
    }
}

// mutations
const mutations = {

    [types.ADD_TO_CART](state, { id, serial }) {
        state.added.push({
            id,
            serial,
            quantity: 1
        })
    }
}

// one store for entire application
export default new Vuex.Store({
    state,
    strict: debug,
    getters,
    actions,
    mutations
})