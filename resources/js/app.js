require('./bootstrap')

window.Vue = require('vue').default;
import "./plugins/bootstrap-vue"
import "./assets/scss/style.scss"

import App from "./App.vue"
import router from "./router/router";
import store from "./store/store";


import { ValidationProvider, extend, required } from 'vee-validate'
import * as rules from 'vee-validate/dist/rules'


/**
 * @extend custom required validate form
 *
 **/
 extend('required', {
    ...rules.required,
    message: 'The {_field_} is required.'
})

/**
* @extend custom min length validate form
*
**/
extend('min', {
    validate(value, { length }) {
        return value.length >= length
    },
    params: ['length'],
    message: 'The {_field_} field must have at least {length} characters.'
})


const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        App,
        ValidationProvider
    },
})
