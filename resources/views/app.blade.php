@extends('_layout')

@section('content')
	<div id="main-content" class="container-fluid">
		<employee-header 
		:active-employees="activeEmployees"
		:employees="employees"></employee-header>
		
		<div class="employee-columns" :style="`width: ${280 * activeEmployees.length}px`">
			<employee-column v-for="e, index in activeEmployees"
			:index="index"
			:key="e.id"
			:employee="e"
			:header-height="headerHeight"
			:row-height="rowHeight"
			:style="`min-width: ${100 / activeEmployees.length}%`"></employee-column>

			<time-marker
			:header-height="headerHeight"
			:row-height="rowHeight"></time-marker>            
		</div>
	</div>
@endsection