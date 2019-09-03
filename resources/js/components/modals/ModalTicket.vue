<template>
	<b-modal id="modal-ticket" title="Ticket">
		<div>
			
		</div>
		<div slot="modal-footer" class="w-100">
			<a class="btn btn-muted">Cancel</a>
	        <a class="btn btn-primary">Send</a>
	    </div>
	</b-modal>
</template>

<script>

	export default {
		data() {
			return {
				slot: {}
			}
		},
		mounted() {
			Event.$on('ticketData', obj => { this.slot = obj })
		},
	}
</script>
