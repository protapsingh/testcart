<template>
  <div class="commerce-products">
    <h3>Products</h3>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th class="col-price">Price</th>
          <th class="col-inventory">Stock</th>
          <th class="col-addtocart"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in allProducts" :key="product.id">
          <td>{{ product.name }}</td>
          <td class="col-price">{{ product.price | currency }}</td>
          <td class="col-inventory">{{ product.stock }}</td>
          <td class="col-addtocart">
            <button :disabled="!product.stock" @click="addItemToCart(product)">Add to cart</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters("products", {
      allProducts: "getAllProducts"
    })
  },
  methods: {
    ...mapActions("cart", {
      addItemToCart: "addItemToCart"
    })
  },
  created() {
    this.$store.dispatch("products/getAllProducts");
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
table .col-price {
  width: 60px;
  text-align: right;
}
table .col-inventory {
  width: 60px;
  text-align: right;
}
table .col-addtocart {
  width: 90px;
  text-align: center;
}
</style>
