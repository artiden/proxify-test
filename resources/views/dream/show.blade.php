@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Просмотр мечты</div>
                    <div>
                        Пользователь {{ $dream->user->name }} хочет {{ $dream->short_description }}.<br />
                        Для этого требуется ${{ $dream->needed }}. На текущий момент собрано ${{ $dream->collected }} ({{ $dream->collectedPercentage}}%).<br />
                        Почему это важно для пользователя: {{ $dream->description }}<br />
                        @if ($dream->link)
                            Также при создании {{ $dream->user->name }} прикрепил <a href = "{{ $dream->link }}">ссылку</a>.<br />
                        @endif
                        @if (!Auth::user() || Auth::user()->id != $dream->user->id)
                            @if (!$dream->closed)
                                Если Вы хотите помочь в осуществлении мечты, <a href = "{{ route('pay_dream', [$dream->id]) }}">внесите $1</a>. {{ $dream->user->name }} будет очень благодарен.
                            @else
                                Сбор средств закончен. Думаем, {{ $dream->user->name }} уже осуществляет мечту. Вы можете <a href = "mailto:{{ $dream->user->email }}">спросить</a> его об этом.
                            @endif
                        @else
                            @if ($dream->closed)
                                Поздравляем, было собрано всю сумму, необходимую Вам для осуществления своей мечты. Вперед! :)
                            @else
                                На данный момент собрано {{ $dream->collectedPercentage }}% требуемой суммы. Рекомендуем больше "шарить" ссылку на эту мечту в соц. сетях и прочих подобных местах. На всякий случай прямая ссылка: {{ route('show_dream', [$dream->id]) }}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
