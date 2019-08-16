<template>
	<b-modal id="modal-slot"
	:title="modalData.action == 'post' ? 'Nueva cita' : 'Editar Cita'">
		<p class="my-3">Llena los siguientes campos:</p>
		<div class="form-group">
			<label>Cliente:</label>
			<autocomplete v-model="formData.client"
			input-class="form-control"
			:initial-value="formData.client"
			:initial-display="returnName(formData.client,'client')"
			:source="formatNames(clients)"></autocomplete>
		</div>
		<div class="form-group">
			<label>Empleado:</label>
			<autocomplete v-model="formData.employee"
			input-class="form-control"
			:initial-value="formData.employee"
			:initial-display="returnName(formData.employee,'employee')"
			:source="formatNames(employees)"></autocomplete>
		</div>
		<div class="form-group">
			<label>Fecha:</label>
			<input type="date" class="form-control" v-model="formData.date" />
			
		</div>
		<div class="row">
			<div class="form-group col pr-1">
				<label>Inicia:</label>
				<input type="time" class="form-control" v-model="formData.begins_at" />
			</div>
			<div class="form-group col pl-1">
				<label>Termina:</label>
				<input type="time" class="form-control" v-model="formData.ends_at" />
			</div>
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted" @click="hideModal">Cancel</a>
	        <a class="btn btn-primary" @click="sendSlot">Send</a>
	    </div>
	</b-modal>
</template>

<script>
	import { BModal } from 'bootstrap-vue'
	// import DatePicker from 'vue2-datepicker'

	export default {
		props: ['employees','clients','date'],
		components: {
			'b-modal': BModal,
			//'datepicker': DatePicker
		},
		data() {
			return {
				modalData: {}
			}
		},
		computed: {
			formData() {
				let data = this.modalData.data
				return {
					client: data && data.client ? data.client.id : 0,
					employee: data && data.employee ? data.employee.id : 0,
					begins_at: data && data.time ? data.time : '',
					date: `${this.date.year}-${this.date.month}-${this.date.day}`
				}
			},
		},
		mounted() {
			Event.$on('modalData', obj => { this.modalData = obj })
		},
		methods: {
			formatNames(arr) {
				arr.map(e => {
					e.name = `${ e.first_name } ${ e.last_name }`
				})
				return arr
			},
			hideModal() {
				this.$root.$emit('bv::hide::modal', 'modal-slot')
			},
			returnName(id,type) {
				console.log(id,type)
				let arr = type == 'client' ? this.formatNames(this.clients) : this.formatNames(this.employees)
				let found = arr.find(e => {
					return e.id === id
				})
				return id ? found.name : ''
			},
			sendSlot() {
				this.formData.store_id = 2
				this.formData.service_id = 2
				axios.post('/slots', this.formData)
				.then(response => {
					console.log(response.data);
					this.hideModal()
				})
			}
		}
	}
</script>
