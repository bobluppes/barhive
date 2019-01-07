@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Dashboard</h1>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as {{Auth::user()->name}}
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <a href="/inventory"><button class="btn btn-primary">Inventory Management</button></a>
                    <a href="/pos"><button class="btn btn-warning">POS Mode</button></a>
                    <a href="/kitchen"><button class="btn btn-success">Kitchen Orders</button></a>
                    <a href="/bar"><button class="btn btn-success">Bar Orders</button></a>
                    <a href="/settings/table"><button class="btn btn-secondary">Table Settings</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
