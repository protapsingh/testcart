
import {ApiCallMaker} from '../../api/ApiCallMaker';

// state
const state = {
  allProducts: []
};

// getters
const getters = {
  getAllProducts: state => {
    return state.allProducts;
  }
};

// actions
const actions = {

 async getAllProducts({ commit }) {
    const response = await ApiCallMaker('GET', '/products', '', '', '');
    if (response && response.data.success==true) {  
        console.log("product list is: ", response.data.data);
        commit('setProducts', response.data.data);
    }   
  }
};

// mutations
const mutations = {
  setProducts(state, products) {
    state.allProducts = products;
  },

  incrementInventoryByProduct(state, { pid }) {
    const product = state.allProducts.find(product => product.id === pid);
    if (product) {
      product.stock++;
    }
  },

  decrementInventoryByProduct(state, { pid }) {
    const product = state.allProducts.find(product => product.id === pid);
    if (product) {
      product.stock--;
    }
  },

  restockInventoryByProduct(state, { pid, quantity }) {
    const product = state.allProducts.find(product => product.id === pid);
    if (product) {
      product.stock += quantity;
    }
  },

};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
