@extends('layouts.admin')

@section('title', 'Contacts')

@section('content')
<div class="mb-8"><h1 class="text-3xl font-bold text-navy dark:text-white">Messages de contact</h1></div>
<div class="bg-white dark:bg-gray-800 rounded-xl card-shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-navy text-white"><tr><th class="text-left py-3 px-4">Nom</th><th class="text-left py-3 px-4">Sujet</th><th class="text-left py-3 px-4">Date</th><th class="text-left py-3 px-4">Lu</th><th class="text-right py-3 px-4">Actions</th></tr></thead>
        <tbody>
            @foreach($contacts as $c)
                <tr class="border-b dark:border-gray-700 {{ !$c->is_read ? 'font-semibold' : '' }}">
                    <td class="py-3 px-4">{{ $c->name }}</td>
                    <td class="py-3 px-4">{{ $c->subject }}</td>
                    <td class="py-3 px-4">{{ $c->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-3 px-4">{{ $c->is_read ? 'Oui' : 'Non' }}</td>
                    <td class="py-3 px-4 text-right"><a href="{{ route('admin.contacts.show', $c) }}" class="text-gold"><i class="fas fa-eye"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $contacts->links() }}</div>
</div>
@endsection
