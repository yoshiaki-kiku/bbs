require('./bootstrap');

window.Vue = require('vue');

Vue.component('vote-component', require('./components/VoteComponent.vue').default);

const app = new Vue({
    el: '#app'
});
