@extends('layouts.admin')

@section('title', 'Message')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.contacts.index') }}" class="text-gold text-sm"><i class="fas fa-arrow-left mr-1"></i>Retour</a>
    <h1 class="admin-page-title mt-2">{{ $contact->subject }}</h1></div>
<div class="form-card max-w-2xl">
    <dl class="space-y-4 text-sm">
        <div><dt class="text-gray-500">De</dt><dd class="font-semibold">{{ $contact->name }} &lt;{{ $contact->email }}&gt;</dd></div>
        @if($contact->phone)<div><dt class="text-gray-500">Téléphone</dt><dd>{{ $contact->phone }}</dd></div>@endif
        <div><dt class="text-gray-500">Date</dt><dd>{{ $contact->created_at->format('d/m/Y à H:i') }}</dd></div>
        <div><dt class="text-gray-500">Message</dt><dd class="mt-2 p-4 bg-light rounded-lg">{{ $contact->message }}</dd></div>
    </dl>
    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="mt-6" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="text-red-500 text-sm"><i class="fas fa-trash mr-1"></i>Supprimer</button></form>
</div>
@endsection
