<template>
	<b-modal id="modal-employee" :title="'Nuevo colaborador'">
		<p class="my-3">Llena los siguientes campos:</p>
		<div class="row">
			<div class="form-group pr-1 col">
				<label>Nombre:</label>
				<input class="form-control" type="text" v-model="employee.first_name">
			</div>
			<div class="form-group pl-1 col">
				<label>Apellido:</label>
				<input class="form-control" type="text" v-model="employee.last_name">
			</div>
		</div>
		<div class="row">
			<div class="form-group pr-1 col">
				<label>Correo:</label>
				<input class="form-control" type="text" v-model="employee.email">
			</div>
			<div class="form-group pl-1 col">
				<label>Teléfono:</label>
				<input class="form-control" type="text" v-model="employee.phone_number">
			</div>
		</div>
		<div class="form-group">
			<label>Sucursal actual:</label>
			<autocomplete v-model="employee.store_id"
			input-class="form-control"
			:source="stores"></autocomplete>
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted" @click="hideModal()">Cancel</a>
	        <a class="btn btn-primary" @click="sendEmployee()">Send</a>
	    </div>
	</b-modal>
</template>

<script>

	export default {
		props: ['stores'],
		data() {
			return {
				employee: {
					first_name: '',
					last_name: '',
					email: '',
					phone_number: '',
					type: 'employee'
				}
			}
		},
		mounted() {
			Event.$on('modalEmployee', obj => { this.modalData = obj })
		},
		methods: {
			sendEmployee() {
				this.employee.owner_id = this.$root.owner_id
				this.employee.selected_date = this.$root.computedDate
				axios.post('/users/', this.employee)
				.then(response => {
					Event.$emit('refresh', response.data.items)
					this.hideModal()
				})
			},
			hideModal() {
				this.$root.$emit('bv::hide::modal', 'modal-employee')
			}
		}
	}
</script>
