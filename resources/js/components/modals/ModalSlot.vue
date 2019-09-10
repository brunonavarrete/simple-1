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
			<label>Servicio:</label>
			<autocomplete v-model="formData.service"
			input-class="form-control"
			:initial-value="formData.service"
			:initial-display="modalData.data.service.name"
			:source="services"
			@selected="setPrice()"></autocomplete>
		</div>
		<div class="form-group">
			<label>Fecha:</label>
			<input type="date" class="form-control" v-model="formData.date" />
			
		</div>
		<div class="row">
			<div class="form-group col pr-1">
				<label>Inicia:</label>
				<select class="form-control" v-model="formData.begins_at">
					<option v-for="q in hoursWithQuarters" 
					v-text="q.substr(0,5)" 
					:value="q" />
				</select>
			</div>
			<div class="form-group col pl-1">
				<label>Termina:</label>
				<select class="form-control" v-model="formData.ends_at">
					<option v-for="q in hoursWithQuarters" 
					v-text="q.substr(0,5)" 
					:value="q" />
				</select>
			</div>
		</div>
		<div class="form-group">
			<label>Estatus:</label>
			<select class="custom-select" v-model="formData.status">
				<option v-for="s in status" :value="s.value">
					{{ s.label }}
				</option>
			</select>
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted" @click="hideModal">Cancel</a>
	        <a class="btn btn-primary" @click="sendSlot">Send</a>
	        <a class="btn btn-success" @click="showTicketModal">Ticket</a>
	    </div>
	</b-modal>
</template>

<script>

	export default {
		props: ['employees','clients','date','services','stores'],
		mounted() {
			Event.$on('modalData', obj => { this.modalData = obj })
		},
		data() {
			return {
				modalData: {
					action: 'post',
					data: {
						begins_at: '',
						client: 0,
						date: '',
						employee: 0,
						ends_at: '',
						id: '',
						service: 0,
						status: 'standby'
					}
				},
				status: [
					{ value: 'stand_by', label: 'En espera' },
					{ value: 'cancelled', label: 'Cancelada' },
					{ value: 'attended', label: 'Atendió' }
				]
			}
		},
		computed: {
			formData() {
				let data = this.modalData.data
				return {
					begins_at: data && data.begins_at ? data.begins_at : '',
					client: data && data.client ? data.client.id : 0,
					date: `${this.date.year}-${this.date.month}-${this.date.day}`,
					employee: data && data.employee ? data.employee.id : 0,
					ends_at: data && data.ends_at ? data.ends_at : '',
					id: data && data.id ? data.id : '',
					cost: data && data.cost ? data.cost : '',
					service: data && data.service ? data.service.id : 0,
					status: data && data.status ? data.status : 'standby',
				}
			},
			hoursWithQuarters() {
				let opts = []
				let quarters = ['00','15','30','45'] // minutes
				for (var hour = 0; hour < 24; hour++) {
					quarters.map(q => {
						let string = hour < 10 ? `0${hour}` : hour
						string = `${string}:${q}:00`
						opts.push(string)
					})
				}

				return opts
			}
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
				let arr = type == 'client' ? this.clients : this.employees
				let name = ''
				arr.map(e => {
					if( e.id == id ) {
						name = e.full_name
					}
				})
				return name
			},
			sendSlot(hide = true) {
				this.formData.store = this.$root.owner_id
				let method = this.modalData.action
				let url = method == 'post' ? '/slots' : `/slots/${this.formData.id}`
				this.formData.selected_date = this.$root.computedDate
				axios({
					method: this.modalData.action,
					data: this.formData,
					url: url,
				}).then(response => {
					Event.$emit('refresh', response.data.items)
					if( hide ) this.hideModal()
				})
			},
			deleteSlot() {
				axios.delete(`/slots/${ this.modalData.data.id }`)
				.then(response => {
					Event.$emit('refresh', response.data.items)
					this.hideModal()
				})
			},
			setPrice() {
				let service_id = this.formData.service
				let service = this.services.find(s => s.id === service_id )				
				this.formData.cost = +(service.cost)
			},
			showTicketModal(){
				this.sendSlot(false)
				Event.$emit('ticketData', this.modalData.data)
				this.$root.$emit('bv::show::modal', 'modal-ticket')
			},
		}
	}
</script>
