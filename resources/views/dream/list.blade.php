@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Мои мечты</div>
                    @forelse ($dreams as $dream)
                        @if ($loop->first)
                            <ul>
                        @endif
                        <li><a href = "{{ route('show_dream', [$dream->id]) }}">{{ $dream->short_description }}</a> ({{ $dream->collectedPercentage }}%)</li>
                        @if ($loop->last)
                            </ul>
                        @endif
                    @empty
                        Для начала работы Вам необходимо <a href = "{{ route('new_dream') }}">создать</a> свою первую мечту.
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
