@extends('layouts.admin')
@section('content')
    <h1>Modifier l'inscription</h1>

    <p><strong>Référence :</strong> {{ $enrollment->enrollment_ref }}</p>
    <p><strong>Participant :</strong> {{ $enrollment->user->name }}</p>
    <p><strong>Formation :</strong> {{ $enrollment->trainingSession->formation->titre_fr }}</p>

    <form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}">
        @csrf @method('PUT')
        <div>
            <label>Statut</label>
            <select name="statut">
                @foreach($statuts as $statut)
                    <option value="{{ $statut->value }}" {{ $enrollment->statut->value == $statut->value ? 'selected' : '' }}>{{ $statut->value }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Note</label><textarea name="note">{{ $enrollment->note }}</textarea></div>
        <button type="submit">Modifier</button>
    </form>
@endsection
