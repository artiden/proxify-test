@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Оплата</div>
                    Вы подтверждаете оплату ${{ $sum }} в пользу пользователя {{ $dream->user->name }} на осуществление его мечты {{ $dream->short_description }}?<br />
                    <button data-xpaystation-widget-open>Buy Credits</button>
                    @include('form.pay') или <a href = "{{ route('show_dream', [$dream->id]) }}">вернутся к просмотру мечты</a>.
                </div>
            </div>
        </div>
    </div>
</div>
    {!! $xsollaScript !!}
@endsection
