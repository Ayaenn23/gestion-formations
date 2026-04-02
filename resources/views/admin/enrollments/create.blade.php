@extends('layouts.admin')
@section('content')
    <h1>Ajouter une inscription</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.enrollments.store') }}">
        @csrf
        <div>
            <label>Participant</label>
            <select name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Session</label>
            <select name="training_session_id">
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}">{{ $session->formation->titre_fr }} - {{ $session->start_date }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Note</label><textarea name="note"></textarea></div>
        <button type="submit">Enregistrer</button>
    </form>
@endsection
