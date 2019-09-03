<template>
	<div id="header-employees">
		<div id="header-employees-list">
			<button class="btn btn-light w-100 h-100" @click="open = !open">
				<eva-icon name="checkmark-square-2-outline" height="20px" fill="lightgray"></eva-icon>
			</button>
			<ul class="dropdown-menu dropdown-menu-right"
			:class="{ 'show': open }">
				<li v-for="e in employees" class="dropdown-item">
					<div class="form-check" @click="toggleEmployee(e.id)">
						<input class="form-check-input" type="checkbox" v-model="e.active">
						<label class="form-check-label">
							{{ e.full_name }}
						</label>
					</div>
				</li>
			</ul>
		</div>
		<div class="employee-columns" :style="`width: ${280 * activeEmployees.length}px;`">
			<div class="employee col py-2 border-right" 
			:style="`min-width: ${100 / activeEmployees.length}%`"
			v-for="e in activeEmployees">
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
	</div>
</template>

<script>
	export default {
		props: ['activeEmployees','employees'],
		data() {
			return {
				open: false
			}
		},
		computed: {
			widthPixels() {
				let windowWidth = window.outerWidth
				let pieces = this.employees.length

				return ((windowWidth - 80) / pieces) - 35
			},
		},
		methods: {
			toggleEmployee(id) {
				axios.post(`/employees/toggle/${id}`)
				.then(response => {
					Event.$emit('toggleEmployees', response.data.employees)
				})
			}
		}

	}
</script>