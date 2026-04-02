@extends('layouts.admin')
@section('content')
    <h1>Inscriptions</h1>
    <a href="{{ route('admin.enrollments.create') }}">Ajouter</a>
    @if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif

    <table border="1">
        <tr><th>Référence</th><th>Participant</th><th>Formation</th><th>Statut</th><th>Actions</th></tr>
        @foreach($enrollments as $enrollment)
        <tr>
            <td>{{ $enrollment->enrollment_ref }}</td>
            <td>{{ $enrollment->user->name }}</td>
            <td>{{ $enrollment->trainingSession->formation->titre_fr }}</td>
            <td>{!! status_badge($enrollment->statut->value) !!}</td>
            <td>
                <a href="{{ route('admin.enrollments.edit', $enrollment) }}">Modifier</a>
                <form method="POST" action="{{ route('admin.enrollments.destroy', $enrollment) }}" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
