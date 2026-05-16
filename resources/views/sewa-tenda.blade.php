@extends('layouts.utama')

@section('konten')
  {{-- Navbar, Modal Login Admin, Panel Admin --}}
  @include('sections.navbar')

  <div style="padding-top: 100px;"></div>

  {{-- Section Layanan Sewa Tenda --}}
  @include('sections.layanan')

  {{-- Section Kalkulator Harga --}}
  @include('sections.kalkulator')
@endsection

@include('sections.scripts')