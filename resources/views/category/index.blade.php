@extends('layouts.app')

@section('title', 'Kategori')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('category.store') }}`)" class="btn btn-primary btn-sm"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>

                <x-table class="categories">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('category.form')
@endsection

@include('includes.datatable')
@include('category.scripts')
