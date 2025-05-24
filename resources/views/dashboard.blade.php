@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="page-header">Dashboard</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-teal">
                <div class="stats-icon"><i class="fa fa-image"></i></div>
                <div class="stats-info">
                    <h4>TOTAL DE PEDIDOS</h4>
                    <p>0</p>
                </div>
            </div>
        </div>
    </div>
@endsection
