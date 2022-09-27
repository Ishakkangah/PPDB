require('./bootstrap');
import Vue from 'vue';
import router from './router';
import store from './store';
import common from './common.js';
import jsonToHtml from './jsonToHtml.js';
Vue.mixin(jsonToHtml);
Vue.mixin(common);

// iview
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);


import Editor from 'vue-editor-js'
Vue.use(Editor)



// jw-vue-pagination
import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

Vue.component('mainapp-component', require('./components/mainapp.vue').default);

const app = new Vue({
    router,
    store,
    el: '#app',
});
