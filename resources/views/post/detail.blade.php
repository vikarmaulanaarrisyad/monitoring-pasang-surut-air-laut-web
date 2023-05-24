@extends('layouts.app')

@section('title', 'Postingan')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Postingan</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@push('css')
<style>
    .daftar-donasi.nav-pills .nav-link.active,
    .daftar-donasi.nav-pills .show>.nav-link {
        background: transparent;
        color: var(--dark);
        border-bottom: 3px solid var(--blue);
        border-radius: 0;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8">
        <x-card>
            <x-slot name="header">
                <h3>{{ $posts->title }}</h3>
                <p class="font-weight-bold mb-0">
                    <small class="d-block">{{ tanggal_indonesia($posts->publish_date) }} {{ date('H:i', strtotime($posts->publish_date)) }}</small>
                </p>
            </x-slot>

            {!! $posts->description !!}

        </x-card>
    </div>
    <div class="col-lg-4">
        <x-card>
            <x-slot name="header">
                <h5 class="card-title">Kategori</h5>
            </x-slot>

            <ul>
                @foreach ($posts->category_post as $item)
                <li>{{ $item->name }}</li>
                @endforeach
            </ul>
        </x-card>

        <x-card>
            <x-slot name="header">
                <h5 class="card-title">Gambar Unggulan</h5>
            </x-slot>

            <img src="{{ Storage::url($posts->path_image) }}" class="img-thumbnail">
        </x-card>

    </div>
</div>
@endsection
