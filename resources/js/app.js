/**
 * 
 * Setup
 * 
 */

    require('./bootstrap');

    window.Vue = require('vue');
    window.Event = new Vue();

/**
 * 
 * App components
 * 
 */
    //
    // Global
    //
        Vue.component('employee-header', require('./components/global/EmployeeHeader.vue').default)
        Vue.component('main-header', require('./components/global/MainHeader.vue').default)

    //
    // View: Today
    //
        Vue.component('time-marker', require('./components/today/TimeMarker.vue').default)
        Vue.component('employee-column', require('./components/today/EmployeeColumn.vue').default)
        Vue.component('hour-row', require('./components/today/HourRow.vue').default)
        Vue.component('hour-slot', require('./components/today/HourSlot.vue').default)

    //
    // Modals
    //
        Vue.component('modal-client', require('./components/modals/ModalClient.vue').default)
        Vue.component('modal-employee', require('./components/modals/ModalEmployee.vue').default)
        Vue.component('modal-service', require('./components/modals/ModalService.vue').default)
        Vue.component('modal-slot', require('./components/modals/ModalSlot.vue').default)
        Vue.component('modal-store', require('./components/modals/ModalStore.vue').default)

/**
 * 
 * External components
 * 
 */
    import Autocomplete from 'vuejs-auto-complete'
    Vue.component('autocomplete', Autocomplete);

    import { BBadge, BModal } from 'bootstrap-vue'
    Vue.component('b-badge', BBadge)
    Vue.component('b-modal', BModal)

    import { DropdownPlugin } from 'bootstrap-vue'
    Vue.use(DropdownPlugin)

    import EvaIcons from 'vue-eva-icons'
    Vue.use(EvaIcons)

/**
 * 
 * Main App Vue instance
 * 
 */
const app = new Vue({
    el: '#app',
    mounted(){
        this.getData()
        Event.$on('refresh', items => this.refreshUsers( items ))
        Event.$on('toggleEmployees', items => { this.employees = items })
        Event.$on('getDateData', date => this.changeDate(date) )
    },
    computed: {
        dateShown() { // https://stackoverflow.com/questions/23593052/format-javascript-date-to-yyyy-mm-dd
            var d = this.date
            let month = '' + (d.getMonth() + 1)
            let day = '' + d.getDate()
            let year = d.getFullYear()

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return {
                day: day,
                month: month,
                year: year
            }
        },
        computedDate() {
            let date = this.dateShown
            return `${date.year}-${date.month}-${date.day}`
        }
    },
    data: {
        clients: [],
        date: new Date(),
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
    methods: {
    	getData() {
    		axios.get(`/get-data/2?date=${ this.computedDate }`)
            .then(response => { 
                this.refreshUsers(response.data.items) 
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
        },
        changeDate(date){
            this.date = new Date(`${date} 00:00:00`)
            this.getData()
        }
    }
});
