
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
window.axios = require('axios');
window.Vue = require('vue');
window.moment = require('moment');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <tiempos-component></tiempos-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('playerchapters-component', require('./components/PlayerChaptersComponent.vue'));
Vue.component('quizcreation-component', require('./components/QuizCreationComponent.vue'));
Vue.component('quizeupdate-component', require('./components/QuizUpdateComponent.vue'));
Vue.component('quizchallenge-component', require('./components/QuizChallengeComponent.vue'));
Vue.component('tiempos-component', require('./components/TiemposComponent.vue'));
Vue.component('selectregister-component', require('./components/SelectAreaPositionComponent.vue'));

Vue.component('popupinsignias-component', require('./components/PopupInsigniasComponent.vue'));

Vue.component('selectregisterupdate-component', require('./components/SelectAreaPositionEditComponent.vue'));


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.onload = function () {
const app = new Vue({
    el: '#app'
});
}