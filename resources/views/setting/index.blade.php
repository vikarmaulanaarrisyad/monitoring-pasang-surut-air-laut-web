@extends('layouts.app')

@section('title', 'Setting')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Setting</li>
@endsection


@section('content')
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if (request('pills') == '') active @endif" href="{{ route('setting.index') }}">Identitas</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade @if (request('pills') == '') show active @endif" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
                @includeIf('setting.general')
            </div>
        </div>
    </div>
</div>

@endsection

@includeIf('includes.summernote')
