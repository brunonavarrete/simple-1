/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();

Vue.component('employee-column', require('./components/EmployeeColumn.vue').default);
Vue.component('hour-row', require('./components/HourRow.vue').default);
Vue.component('hour-slot', require('./components/HourSlot.vue').default);

/* Modals */
    Vue.component('modals', require('./components/Modals.vue').default);
    Vue.component('modal-slot', require('./components/ModalSlot.vue').default);

/* App */

import Autocomplete from 'vuejs-auto-complete'
Vue.component('autocomplete', Autocomplete);

const app = new Vue({
    el: '#app',
    data: {
    	clients: [],
    	employees: [],
    	headerHeight: 65,
    	modalData: {
    		title: '',
    		text: '',
    		type: ''
    	},
    	rowHeight: 115
    },
    mounted(){
    	this.getUsers()
    },
    methods: {
    	getUsers() {
    		axios.get('/users/owner/2')
    		.then(request => {
    			request.data.map(u => {
    				if( u.type !== 'manager' ) {
    					let arr = `${ u.type }s`
    					this[arr].push(u)
    				}
    			})
    		})
    	},
        sendData() {

        }
    }
});
