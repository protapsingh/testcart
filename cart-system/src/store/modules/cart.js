import {ApiCallMaker} from '../../api/ApiCallMaker';
// state
const state = {
  cartItems: [],
};

// getters
const getters = {
 
  getCartItems: (state, getters, rootState) => {

    return state.cartItems.map(({ itemId, quantity }) => {
      const product = rootState.products.allProducts.find(
        product => product.id === itemId
      );
      return {
        itemId: product.id,
        title: product.name,
        price: product.price,
        quantity: quantity,
        inventory: product.stock
      };
    });
  },

  getCartTotal: (state, getters) => {
    return getters.getCartItems.reduce((total, product) => {
      return total + product.price * product.quantity;
    }, 0);
  }
};

// actions
const actions = {
  async addItemToCart({ state, commit }, product) {
    
    if (product.stock > 0) {
      const cartItem = state.cartItems.find(
        item => item.itemId === product.id
      );
      if (!cartItem) {
        let data = {
          product_id: product.id, 
          quantity  :1,
          };
        const response = await ApiCallMaker('POST', '/cartitems',data, '','');
        if (response && response.data.success==true) { 
          commit('addItemToCart', { itemId: product.id });
        }

      } else {
        commit('incrementQuantityByCartItem', { itemId: product.id });
      }
      // remove 1 item from stock
      commit(
        'products/decrementInventoryByProduct',
        { pid: product.id },
        { root: true }
      );
    }
  },
  async addInitialItemToCart({ state, commit }) {

    const response = await ApiCallMaker('GET', '/get-user-cart','', '','');
    if (response && response.data.success==true) { 
      commit('addInitialItemToCart',response.data.data.cart_items);
    }
  },
  
  removeItemFromCart({ state, commit, rootState }, cartItem) {
    commit('removeItemFromCart', { itemId: cartItem.itemId });
    commit(
      'products/restockInventoryByProduct',
      { pid: cartItem.itemId, quantity: cartItem.quantity },
      { root: true }
    );
  },

  removeCart({ state, commit }) {
    commit('resetCart');
  },

  async incrementQuantityByCartItem({ state, commit, rootState }, { itemId }) {
    const cartItem = state.cartItems.find(item => item.itemId === itemId);
    if (cartItem) {
      let data ={
        product_id: cartItem.itemId, 
        quantity  :cartItem.quantity+1,
        
        };
      const response = await ApiCallMaker('PUT', '/cartitems/'+cartItem.itemId,data, '','');
      if (response && response.data.success==true) { 
        commit('incrementQuantityByCartItem', { itemId: itemId });
        commit(
          'products/decrementInventoryByProduct',
          { pid: itemId },
          { root: true }
        );
      }

      
    }
  },
 async decrementQuantityByCartItem({ state, commit, rootState }, { itemId }) {
    const cartItem = state.cartItems.find(item => item.itemId === itemId);
    if (cartItem) {

      let data = {
        product_id: cartItem.itemId, 
        quantity  :cartItem.quantity-1,
      
        };
      const response = await ApiCallMaker('PUT', '/cartitems/'+cartItem.itemId,data, '','');
      if (response && response.data.success==true) { 
        commit('decrementQuantityByCartItem', { itemId: itemId });
        commit(
          'products/incrementInventoryByProduct',
          { pid: itemId },
          { root: true }
        );
      }
      
     
    }
  }
};

// mutations
const mutations = {
  addItemToCart(state, { itemId }) {
    state.cartItems.push({
      itemId: itemId,
      quantity: 1
    });
  },

  addInitialItemToCart(state, initialData) {
    // console.log('int data',initialData);
    initialData.forEach(item => {
          state.cartItems.push({
            itemId: item.product_id,
            quantity: item.quantity
          });
        });
      
  },

  removeItemFromCart(state, { itemId }) {
    const cartItem = state.cartItems.find(item => item.itemId === itemId);
    if (cartItem) {
      state.cartItems.splice(state.cartItems.indexOf(cartItem), 1);
    }
  },

  resetCart(state) {

      state.cartItems=[];
  },

  incrementQuantityByCartItem(state, { itemId }) {
    const cartItem = state.cartItems.find(item => item.itemId === itemId);
    if (cartItem) {
      cartItem.quantity++;
    }
  },

  decrementQuantityByCartItem(state, { itemId }) {
    const cartItem = state.cartItems.find(item => item.itemId === itemId);
    if (cartItem) {
      cartItem.quantity--;
      if (cartItem.quantity === 0) {
        state.cartItems.splice(state.cartItems.indexOf(cartItem), 1);
      }
    }
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
