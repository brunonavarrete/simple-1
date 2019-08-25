<template>
	<b-modal id="modal-client" :title="'Nuevo cliente'">
		<p class="my-3">Llena los siguientes campos:</p>
		<div class="row">
			<div class="form-group pr-1 col">
				<label>Nombre:</label>
				<input class="form-control" type="text" v-model="client.first_name">
			</div>
			<div class="form-group pl-1 col">
				<label>Apellido:</label>
				<input class="form-control" type="text" v-model="client.last_name">
			</div>
		</div>
		<div class="row">
			<div class="form-group pr-1 col">
				<label>Correo:</label>
				<input class="form-control" type="text" v-model="client.email">
			</div>
			<div class="form-group pl-1 col">
				<label>Teléfono:</label>
				<input class="form-control" type="text" v-model="client.phone_number">
			</div>
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted" @click="hideModal()">Cancel</a>
	        <a class="btn btn-primary" @click="sendClient()">Send</a>
	    </div>
	</b-modal>
</template>

<script>

	export default {
		props: [],
		data() {
			return {
				client: {
					first_name: '',
					last_name: '',
					email: '',
					phone_number: '',
					type: 'client'
				}
			}
		},
		mounted() {
			Event.$on('modalClient', obj => { this.modalData = obj })
		},
		methods: {
			sendClient() {
				this.client.owner_id = 2
				axios.post('/users/', this.client)
				.then(response => {
					Event.$emit('refresh', response.data.items.users)
					this.hideModal()
				})
			},
			hideModal() {
				this.$root.$emit('bv::hide::modal', 'modal-client')
			}
		}
	}
</script>
