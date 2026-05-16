@extends('layouts.utama')

@section('konten')
  {{-- Navbar, Modal Login Admin, Panel Admin --}}
  @include('sections.navbar')

  <div style="padding-top: 100px;"></div>

  {{-- Section Kost Putri --}}
  @include('sections.kost')
@endsection

@include('sections.scripts')