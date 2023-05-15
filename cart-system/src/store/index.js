import Vue from 'vue';
import Vuex from 'vuex';
import cart from './modules/cart';
import products from './modules/products';

Vue.use(Vuex);

const debug = true;

export default new Vuex.Store({
  modules: {
    cart,
    products
  },
  strict: debug
});
