<template>
  <div id='app'>
    <table>
      <tr>
        <td><commerce-products></commerce-products></td>
      </tr>
      <tr>
        <td><commerce-cart></commerce-cart></td>
      </tr>
    </table>
    
  </div>
</template>

<script>
import CommerceCart from './components/CommerceCart';
import CommerceProducts from './components/CommerceProducts';

export default {
  name: 'App',
  components: {
    CommerceCart,
    CommerceProducts
  }
};
</script>

<style>
table {
  width: 100%;
}
</style>
