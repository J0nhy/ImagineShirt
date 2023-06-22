@can('viewAny', \App\Models\orders::class)
@extends('adminLayout')
@section('main')

<section class="sec-product-detail bg0 background">
    <h2 class="breadcrumbs linkBranco">Olá, {{ Auth::user()->name }}</h2>
</section>
@endsection
@endcan
