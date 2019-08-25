/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();

/* App components */
    Vue.component('main-header', require('./components/MainHeader.vue').default)
    Vue.component('time-marker', require('./components/TimeMarker.vue').default)
    Vue.component('employee-column', require('./components/EmployeeColumn.vue').default)
    Vue.component('hour-row', require('./components/HourRow.vue').default)
    Vue.component('hour-slot', require('./components/HourSlot.vue').default)

    /* Modals */
        Vue.component('modals', require('./components/Modals.vue').default)
        Vue.component('modal-client', require('./components/ModalClient.vue').default)
        Vue.component('modal-employee', require('./components/ModalEmployee.vue').default)
        Vue.component('modal-service', require('./components/ModalService.vue').default)
        Vue.component('modal-slot', require('./components/ModalSlot.vue').default)

/* Outside components */
    import Autocomplete from 'vuejs-auto-complete'
    Vue.component('autocomplete', Autocomplete);

    import { BBadge, BModal } from 'bootstrap-vue'
    Vue.component('b-badge', BBadge)
    Vue.component('b-modal', BModal)

    import { DropdownPlugin } from 'bootstrap-vue'
    Vue.use(DropdownPlugin)

    import EvaIcons from 'vue-eva-icons'
    Vue.use(EvaIcons)

/* App */
const app = new Vue({
    el: '#app',
    computed: {
        dateShown() { // https://stackoverflow.com/questions/23593052/format-javascript-date-to-yyyy-mm-dd
            var d = new Date(),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return {
                day: day,
                month: month,
                year: year
            }
        }
    },
    data: {
        clients: [],
        employees: [],
        managers: [],
    	headerHeight: 135,
    	modalData: {
    		title: '',
    		text: '',
    		type: ''
    	},
    	rowHeight: 85,
        services: [],
        stores: []
    },
    mounted(){
    	this.getData()
        Event.$on('refresh', items => this.refreshUsers( items ))
    },
    methods: {
    	getData() {
    		axios.get('/get-data/2')
    		.then(request => {
    			this.refreshUsers(request.data.items)
    		})
    	},
        refreshUsers(obj) {
            this.clients = []
            this.employees = []
            this.managers = []
            this.services = []
            this.stores = []
            
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {
                    obj[key].map((item) => {
                        let arrString = ( key === 'users' ) ? `${item.type}s` : key
                        this[arrString].push(item)
                    })
                }
            }
        }
    }
});
