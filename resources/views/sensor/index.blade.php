@extends('layouts.app')

@section('title', 'Data Pasang Surut Air Laut')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Monitoring</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-6">
            <x-card>
                <x-slot name="header">
                    <h5>Filter Tanggal</h5>
                </x-slot>
                <div class="form-group mb-2">
                    <input type="text" class="form-control float-right" name="datefilter" placeholder="Masukan tanggal"
                        autocomplete="off">
                </div>

            </x-card>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-6">
            <x-card>
                <x-slot name="header">
                    <h5>Filter Status</h5>
                </x-slot>

                <div class="form-group">
                    <select name="status2" id="status2" class="custom-select">
                        <option value="Aman" {{ request('status') == 'Aman' ? 'selected' : '' }}>Aman</option>
                        <option value="Siaga" {{ request('status') == 'Siaga' ? 'selected' : '' }}>Siaga</option>
                        <option value="Bahaya" {{ request('status') == 'Bahaya' ? 'selected' : '' }}>Bahaya</option>
                    </select>
                </div>
            </x-card>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
            <x-card>
                <x-slot name="header">
                  <div class="btn-group">
                        <button data-toggle="modal" data-target="#modal-form" class="btn btn-primary"><i
                                class="fas fa-pencil-alt"></i> Ubah Periode</button>
                        <a target="_blank" href="{{ route('report.export_pdf', compact('start','end')) }}"
                            class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</a>
                    </div>
                </x-slot>
                <x-table class="table-sensor">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Tinggi Air</th>
                            <th>Kecepatan</th>
                            <th>Status</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('sensor.form')
@endsection

@include('includes.datatable')
@include('includes.daterangepicker')
@include('includes.datepicker')
@include('sensor.scripts')
