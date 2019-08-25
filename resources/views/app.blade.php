@extends('_layout')

@section('content')
    <div id="main-content" class="container-fluid">
        <div class="row mx-0">
            <employee-column v-for="e, index in employees"
            :index="index"
            :key="e.id"
            :employee="e"
            :header-height="headerHeight"
            :row-height="rowHeight"></employee-column>

            <time-marker
            :header-height="headerHeight"
            :row-height="rowHeight"></time-marker>            
        </div>
    </div>
@endsection