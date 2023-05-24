@extends('layouts.app')

@section('title', 'Data Pasang Surut Air Laut')

@section('breadcrumb')
 <li class="breadcrumb-item active">Data Pasang Surut Air Laut</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7 col-lg-7 col-sm-7 col-7">
            <x-card>
                <x-slot name="header">
                    <h5>Filter Tanggal</h5>
                </x-slot>

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-12">
                        <div class="form-group">
                            <input type="text" class="form-control float-right" name="datefilter"
                                placeholder="Masukan tanggal" autocomplete="off">
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
            <x-card>
                <x-table class="table-sensor">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Tinggi Air</th>
                            <th>Status</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
@endsection

@include('includes.datatable')
@include('includes.daterangepicker')
@include('sensor.scripts')
