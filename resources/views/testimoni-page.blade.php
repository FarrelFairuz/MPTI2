@extends('layouts.utama')

@section('konten')
  {{-- Navbar, Modal Login Admin, Panel Admin --}}
  @include('sections.navbar')

  <div style="padding-top: 100px;"></div>

  {{-- Section Testimoni --}}
  @include('sections.testimoni')
@endsection

@include('sections.scripts')