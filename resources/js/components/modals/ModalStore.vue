<template>
	<b-modal id="modal-store" :title="'Nueva sucursal'">
		<p class="my-3">Llena los siguientes campos:</p>
		<div class="row">
			<div class="form-group col">
				<label>Nombre:</label>
				<input class="form-control" type="text" v-model="store.name">
			</div>
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted" @click="hideModal()">Cancel</a>
	        <a class="btn btn-primary" @click="sendStore()">Send</a>
	    </div>
	</b-modal>
</template>

<script>

	export default {
		data() {
			return {
				store: {
					name: ''
				}
			}
		},
		methods: {
			sendStore() {
				this.store.owner_id = this.$root.owner_id
				this.store.selected_date = this.$root.computedDate
				axios.post('/stores/', this.store)
				.then(response => {
					Event.$emit('refresh', response.data.items)
					this.hideModal()
				})
			},
			hideModal() {
				this.$root.$emit('bv::hide::modal', 'modal-store')
			}
		}
	}
</script>
