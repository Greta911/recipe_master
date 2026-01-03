@extends('template.app')

@section('main_content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Nos Chefs Cuisiniers</h2>

{{-- Appel du composant Livewire --}}
<livewire:chef-list />
@endsection