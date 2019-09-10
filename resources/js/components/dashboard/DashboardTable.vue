<template>
	<b-table striped responsive :items="items" :fields="fields">
		<template slot="actions" slot-scope="data">
			<eva-icon name="edit" width="15px" height="15px" fill="gold"></eva-icon>
			<eva-icon name="trash-2" width="15px" height="15px" fill="red"></eva-icon>
		</template>
	</b-table>
</template>

<script>
	export default {
		props: ['items'],
		data() {
			return {
				fields: [
					{ label: 'Nombre', key: 'full_name', sortable: true },
					{ label: 'Correo', key: 'email', sortable: true },
					{ label: 'Sucursal', key: 'store.name', sortable: true },
					{ key: 'actions', sortable: false }
				]
			}
		}
	}
</script>