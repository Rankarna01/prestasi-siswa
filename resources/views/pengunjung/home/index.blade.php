@extends('layouts.public')

@section('title', 'Beranda - Prestasi Siswa & Alumni')

@section('content')

    @include('pengunjung.home.partials.hero')

    @include('pengunjung.home.partials.about')

    @include('pengunjung.home.partials.unggulan')

    @include('pengunjung.home.partials.timeline')

    @include('pengunjung.home.partials.features')

    @include('pengunjung.home.partials.cta')

@endsection