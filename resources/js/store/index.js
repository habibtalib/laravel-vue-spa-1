import Vue from 'vue'
import Vuex from 'vuex'
import * as types from './mutation-types'
import axios from "axios";

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'
// initial state
const state = {
    added: [],
    orders: [],
    user: {},
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
    orders: state => state.orders,
    user: state => state.user,
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
            quantity: product.quantity || 1,
            serial: product.serial
        });
    },
    removeCart({ commit }, product) {
        console.log("remove", product);
        commit(types.REMOVE_CART, {
            id: product.id,
            quantity: product.quantity,
            serial: product.serial
        });
    },
    loadProducts({ commit }) {
        axios
            .get('/products')
            .then(r => r.data)
            .then(coins => {
                commit("SET_COINS", coins.data);
            })
    },
    loadUser({ commit }) {
        axios
            .get('/user')
            .then(r => r.data)
            .then(coins => {
                commit("SET_USER", coins.user);
            })
    },
    loadMerhandise({ commit }) {
        axios
            .get('/merchandise')
            .then(r => r.data)
            .then(coins => {
                commit("SET_COINS", coins.data);
            })
    },
    loadOrders({ commit }) {
        axios
            .get('/orders')
            .then(r => r.data)
            .then(coins => {
                commit("SET_ORDERS", coins.data);
            })
    },
    loadDownlineOrders({ commit }) {
        axios
            .get('/buyer-orders')
            .then(r => r.data)
            .then(coins => {
                commit("SET_ORDERS", coins.data);
            })
    }
}

// mutations
const mutations = {

    [types.ADD_TO_CART](state, { id, serial, quantity }) {
        var product = state.added.find(p => p.id === id)
        if (product) {
            state.added.splice(state.added.findIndex(p => p.id === id), 1)
            quantity = product.quantity + quantity
            state.added.push({
                id,
                serial,
                quantity
            })
        } else {
            state.added.push({
                id,
                serial,
                quantity
            })
        }
        
    },
    [types.REMOVE_CART](state, { id, serial }) {
        state.added.splice(state.added.findIndex(p => p.id === id),1)
    },
    SET_COINS(state, coins) {
        state.all = coins;
    },
    SET_ORDERS(state, coins) {
        state.orders = coins;
    },
    SET_USER(state, coins) {
        state.user = coins;
    },
}

// one store for entire application
export default new Vuex.Store({
    state,
    strict: debug,
    getters,
    actions,
    mutations
})