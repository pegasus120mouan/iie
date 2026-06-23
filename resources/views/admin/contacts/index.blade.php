@extends('layouts.admin')

@section('title', 'Contacts')

@section('content')
<div class="admin-page-header"><h1 class="admin-page-title">Messages de contact</h1></div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Nom</th><th>Sujet</th><th>Date</th><th>Lu</th><th class="text-right">Actions</th></tr></thead>
        <tbody>
            @foreach($contacts as $c)
                <tr class="{{ !$c->is_read ? 'font-semibold' : '' }}">
                    <td class="text-navy">{{ $c->name }}</td>
                    <td>{{ $c->subject }}</td>
                    <td class="text-slate">{{ $c->created_at->format('d/m/Y H:i') }}</td>
                    <td><span class="badge-status {{ $c->is_read ? 'badge-active' : 'badge-pending' }}">{{ $c->is_read ? 'Oui' : 'Non' }}</span></td>
                    <td class="text-right"><a href="{{ route('admin.contacts.show', $c) }}" class="text-gold hover:underline"><i class="fas fa-eye"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $contacts->links() }}</div>
</div>
@endsection
