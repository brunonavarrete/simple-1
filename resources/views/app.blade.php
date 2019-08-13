@extends('_layout')

@section('content')
    <div class="container-fluid px-0">
        <div class="row mx-0">
            <employee-column v-for="e in employees"
            :key="e.id"
            :employee="e"
            :header-height="headerHeight"
            :row-height="rowHeight"></employee-column>

            <modals></modals>
            
        </div>
    </div>
@endsection