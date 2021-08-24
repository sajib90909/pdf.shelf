import Vue from "vue";

Vue.component('app-table', require('./components/table/index').default);
Vue.component('app-pagination', require('./components/table/pagination').default);
Vue.component('app-modal', require('./components/modal/modal').default);
Vue.component('app-input', require('./components/input/index').default);
Vue.component('app-authenticate-user', require('./components/Auth/AuthenticateUser').default);

Vue.prototype.$hub = new Vue();
