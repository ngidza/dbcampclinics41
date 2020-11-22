
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        msg: 'ngirande',
        data:[],
    },

    ready: function(){
        this.created();
    },

    created(){
        axios.get('http://127.0.0.1:8000/receptions/patients')
        .then(response => {
            console.log(response.data); // show if success
            app.data = response.data; //we are putting data into our posts array
          })
          .catch(function (error) {
            console.log(error); // run if we have error
          });
    },
    method:{

    },
});
