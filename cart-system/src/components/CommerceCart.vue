<template>
  <div class="commerce-cart">
    <h3>Cart</h3>
    <div v-if="!cartItems.length"><i>Please add some products to cart.</i></div>
    <table v-if="cartItems.length">
      <thead>
        <tr>
          <th>Name</th>
          <th class="col-price">Price</th>
          <th class="col-quantity">Quantity</th>
          <th class="col-price">Total</th>
          <th class="col-action"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in cartItems" :key="item.itemId">
          <td>{{ item.title }}</td>
          <td class="col-price">{{ item.price | currency }}</td>
          <td class="col-quantity">
            <button :disabled="item.inventory <= 0" @click="incrementQuantityByCartItem(item)">+</button>
            <span class="quantity">{{ item.quantity }}</span>
            <button :disabled="item.quantity <= 0" @click="decrementQuantityByCartItem(item)">-</button>
          </td>
          <td class="col-price">{{ item.price * item.quantity | currency }}</td>
          <td class="col-action">
            <button @click="removeItemFromCart(item)">x</button>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td>
            <button @click="removeCart()">Checkout</button>
          </td>
          <td colspan="5"><strong>Total:</strong> {{ cartTotal | currency }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  mounted() {
    this.addInitialItemToCart()
  },
  computed: {
    ...mapGetters('cart', {
      cartItems: 'getCartItems',
      cartTotal: 'getCartTotal'
    }),
    
  },
  methods: {
    ...mapActions("cart", {
      removeCart: 'removeCart',
      removeItemFromCart: 'removeItemFromCart',
      incrementQuantityByCartItem: 'incrementQuantityByCartItem',
      decrementQuantityByCartItem: 'decrementQuantityByCartItem',
      addInitialItemToCart: 'addInitialItemToCart',
    })
  }
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #333;
}
table thead th {
  background: #333;
  color: #fff;
  padding: 5px 10px;
  text-align: left;
}
table tbody td {
  background: #fff;
  color: #000;
  border: 1px solid #ccc;
  padding: 5px 10px;
  text-align: left;
}
table tfoot td {
  background: #fff;
  color: #000;
  border: 1px solid #ccc;
  padding: 15px 10px;
  text-align: right;
}
table .col-price {
  width: 60px;
  text-align: right;
}
table .col-quantity {
  width: 120px;
  text-align: center;
}
table .col-quantity button {
  margin: 0 8px;
  width: 25px;
  height: 25px;
}
table .col-quantity .quantity {
  display: inline-block;
  min-width: 20px;
}
table .col-action {
  width: 30px;
  text-align: center;
}
table .col-action button {
  width: 25px;
  height: 25px;
}
</style>
