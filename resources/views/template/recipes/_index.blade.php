@extends('template.app')
@section('main_content')
<h2 class="text-2xl font-bold mb-4">Recettes</h2>
@include('template.recipes._card')
<div class="mt-8">
    {{ $recipes->links() }}
</div>
@endsection