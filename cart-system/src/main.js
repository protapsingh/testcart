
import Vue from 'vue';
import Vue2Filters from 'vue2-filters';
import Vuex from 'vuex';
import App from './App';
import store from './store';

Vue.use(Vuex);
Vue.use(Vue2Filters);
Vue.config.productionTip = false;


new Vue({
  el: '#app',
  store,
  components: { App },
  template: '<App/>',
});
