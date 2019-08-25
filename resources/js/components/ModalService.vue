<template>
	<b-modal id="modal-service" :title="'Nuevo servicio'">
		<p class="my-3">Llena los siguientes campos:</p>
		<div class="row">
			<div class="form-group pr-1 col">
				<label>Nombre:</label>
				<input class="form-control" type="text" v-model="service.name">
			</div>
			<div class="form-group pl-1 col">
				<label>Precio:</label>
				<input class="form-control" type="text" v-model="service.cost">
			</div>
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted" @click="hideModal()">Cancel</a>
	        <a class="btn btn-primary" @click="sendEmployee()">Send</a>
	    </div>
	</b-modal>
</template>

<script>

	export default {
		data() {
			return {
				service: {
					name: '',
					cost: ''
				}
			}
		},
		methods: {
			sendEmployee() {
				this.service.owner_id = 2
				axios.post('/services/', this.service)
				.then(response => {
					Event.$emit('refresh', response.data.items.users)
					this.hideModal()
				})
			},
			hideModal() {
				this.$root.$emit('bv::hide::modal', 'modal-service')
			}
		}
	}
</script>
