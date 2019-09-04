<template>
	<b-modal id="modal-ticket" title="Ticket">
		<div v-if="slot && slot.ticket" id="modal-ticket-rows">
			<concept-row v-for="c in slot.ticket.concepts" 
			:concept="c"
			:key="c.id"></concept-row>
		</div>
		<p v-else>Este ticket está vacío</p>
		<form class="row mt-3" @submit.prevent="sendConcept">
			<h4 class="col-12 h5">Agregar concepto</h4>
			<div class="form-group col-12 col-md pr-md-1">
				<input class="form-control" v-model="newConcept.concept" />
			</div>
			<div class="form-group col-12 col-md px-md-1">
				<input class="form-control" v-model="newConcept.cost" />
			</div>
			<div class="form-group col-12 col-md-auto pl-md-1">
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>
		</form>
		<div class="row align-items-center">
			<h4 class="form-group col-12 col-md pr-md-1">Total</h4>
			<div class="form-group col-12 col-md px-md-1">
				<input class="form-control" v-model="ticketTotal" />
			</div>
			<div class="form-group col-12 col-md-auto pl-md-1">
				<button class="btn btn-success"disabled style="visibility:hidden;">Guardar</button>
			</div>
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted" @click="hideModal">Volver</a>
	    </div>
	</b-modal>
</template>

<script>

	export default {
		data() {
			return {
				slot: {
					id: 0,
					ticket: {}
				},
				newConcept: {
					concept: '',
					cost: 0,
					ticket: 0,
					selected_date: ''
				}
			}
		},
		mounted() {
			Event.$on('ticketData', obj => { this.slot = obj })
			Event.$on('modalData', obj => { this.slot = obj.data })
		},
		computed: {
			ticketTotal() {
				let total = 0
				this.slot.ticket.concepts.map(c => {
					total += Number( c.cost )
				})
				return total
			}
		},
		methods: {
			sendConcept() {
				this.newConcept.selected_date = this.$root.computedDate
				this.newConcept.ticket_id = this.slot.ticket.id
				axios.post('/concepts', this.newConcept)
				.then(response => {
					Event.$emit('refresh', response.data.items)
					Event.$emit('ticketData', response.data.slot)
					this.resetConcept
				})
			},
			resetConcept() {
				this.newConcept = {
					concept: '',
					cost: 0,
					ticket: 0,
					selected_date: ''
				}
			},
			hideModal() {
				this.$root.$emit('bv::hide::modal', 'modal-ticket')
			}
		}
	};
</script>
<style lang="scss">
	#modal-ticket-rows {
		max-height: 180px;
		overflow-y: auto;
		overflow-x: hidden;
	}
</style>