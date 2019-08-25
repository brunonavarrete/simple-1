<template>
	<header id="main-header" class="container-fluid d-flex flex-column" :style="`height: ${ headerHeight }px`">
		<div id="main-header-nav" class="row border-bottom py-2">
			<div class="col d-flex align-items-center" @click="showModal('hi')">
				LOGO
			</div>
			<div class="col-auto ml-auto d-flex align-items-center">
				<ul class="list-unstyled m-0 d-flex">
					<li class="mr-4">Clientes</li>
					<li class="mr-4">Colaboradores</li>
					<li class="mr-4">Sucursales</li>
				</ul>
				<b-dropdown id="dropdown-create" class="mr-2" 
				variant="info" lazy right>
					<template slot="button-content">
						<div class="d-flex align-items-center">
					      	<span class="mr-1 text-white">Reportes</span>
					      	<eva-icon name="trending-up" width="15px" height="15px" fill="white"></eva-icon>
					    </div>
				    </template>
				    <b-dropdown-item-button class="text-right"
				    v-for="link, index in navs.reports"
				    @click="showModal(link.action)"
				    :key="index">
				    	{{ link.text }}
				    	<b-badge variant="warning">Plus</b-badge>
				    </b-dropdown-item-button>
				</b-dropdown>
				<b-dropdown id="dropdown-create" class="mr-2" 
				variant="success" lazy right>
					<template slot="button-content">
						<div class="d-flex align-items-center">
					      	<span class="mr-1">Agregar</span>
					      	<eva-icon name="plus" width="15px" height="15px" fill="white"></eva-icon>
					    </div>
				    </template>
				    <b-dropdown-item-button class="text-right"
				    v-for="link, index in navs.create"
				    @click="showModal(link.action)"
				    :key="index">
				    	{{ link.text }}
				    </b-dropdown-item-button>
				</b-dropdown>
				<button class="btn btn-secondary">
					<eva-icon name="person" width="15px" height="15px" fill="white"></eva-icon>
				</button>
			</div>
		</div>
		<div id="main-header-employees" class="row mt-auto">
			<div class="employee col py-2 border-right" v-for="e in employees">
				<span class="d-block"
				:title="e.full_name"
				:style="`max-width: ${ widthPixels }px`">
					{{ e.full_name }}
				</span>
				<small class="d-block"
				:title="e.store.name"
				:style="`max-width: ${ widthPixels }px`">
					{{ e.store.name }}
				</small>
			</div>
		</div>

	</header>
</template>

<script>
	export default {
		props: ['employees','headerHeight'],
		data() {
			return {
				navs: {
					create: [
						{ action: 'modal-slot', text: 'Cita' },
						{ action: 'modal-client', text: 'Cliente' },
						{ action: 'modal-employee', text: 'Colaborador' },
						{ action: 'modal-service', text: 'Servicio' },
						{ action: 'modal-store', text: 'Sucursal' },
					],
					reports: [
						{ action: 'clients', text: 'Top clientes' },
						{ action: 'employees', text: 'Top colaboradores' },
						{ action: 'sales', text: 'Ventas' },
					],
				}
			}
		},
		computed: {
			widthPixels() {
				let windowWidth = window.outerWidth
				let pieces = this.employees.length

				return ((windowWidth - 80) / pieces) - 35
			}
		},
		methods: {
			showModal(action){
				this.$root.$emit('bv::show::modal', action)
			}
		}

	}
</script>