@extends('_layout')

@section('content')
	<aside id="dashboard-sidebar">
		<nav class="list-unstyled">
			<li>Clientes</li>
			<li class="active">Colaboradores</li>
			<li>Sucursales</li>
		</nav>
	</aside>
	<div id="main-content" class="container-fluid dashboard">
		<h1 class="display-4">Colaboradores</h1>			
		<dashboard-table :items="employees"></dashboard-table>
	</div>
@endsection