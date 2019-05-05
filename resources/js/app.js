
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('booking', require('./components/BookingNotification.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        order: '',
        user: ''
    },
    created(){
        if (window.Laravel.userId) {
            axios.post('/notifications-booking').then(res => {
                this.order = res.data['order'];
                user.user = res.data['user'];
                console.log(res.data)
            })
        };
        Echo.private("App.Models.User."+ window.Laravel.userId).notification((res) => {
            data = {
                "data": res
            }
            this.order.push(data['order']);
            this.user.push(data['user']);
            console.log(res);
        });
    }
});
