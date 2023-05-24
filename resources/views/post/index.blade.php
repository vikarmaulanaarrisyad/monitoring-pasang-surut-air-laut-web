@extends('layouts.app')

@section('title', 'Postingan')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Postingan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('posts.store') }}`)" class="btn btn-primary btn-sm"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>

                <x-table class="posts">
                    <x-slot name="thead">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%"></th>
                            <th>Deskripsi</th>
                            <th>Tgl Publish</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('post.form')
@endsection

@include('includes.datatable')
@include('post.scripts')
@include('includes.summernote')
@include('includes.datepicker')
@include('includes.select2')
