require('./bootstrap');

window.Vue = require('vue');

Vue.component('vote-component', require('./components/VoteComponent.vue').default);
Vue.component('select-file-component', require('./components/SelectFileComponent.vue').default);

const app = new Vue({
    el: '#app'
});

