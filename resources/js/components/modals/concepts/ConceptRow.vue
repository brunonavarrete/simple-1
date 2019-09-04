<template>
	<form class="row" @submit.prevent="sendConcept">
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
</template>

<script>
	export default {
		props: ['concept'],
		data() {
			return {
				newConcept: {
					id: 0,
					concepto: '',
					cost: 0,
					ticket: 0,
					selected_date: ''
				}
			}
		},
		mounted() {
			this.setNew()
		},
		methods: {
			sendConcept() {
				this.newConcept.selected_date = this.$root.computedDate
				this.newConcept.ticket_id = this.newConcept.ticket_id
				axios.put(`/concepts/${ this.newConcept.id }`, this.newConcept)
				.then(response => {
					Event.$emit('refresh', response.data.items)
					Event.$emit('ticketData', response.data.slot)
					this.resetConcept
				})
			},
			setNew() {
				this.newConcept = this.concept
			}
		}
	}
</script>