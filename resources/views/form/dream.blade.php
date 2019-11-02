<form action = "{{ route('store_dream') }}" method = "post">
    @csrf
        <div class="form-group">
        <label for="fld_short">Краткое описание</label>
        <input name = "short_description" type="text" class="form-control" id="fld_short" aria-describedby="shortHelp" placeholder="Полететь в космос">
        <small id="shortHelp" class="form-text text-muted">Кратко, в пару слов опишите чего бы вам хотелось...</small>
        @error('short_description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="fld_needed">Требуемая сумма</label>
        <input name = "needed" type="number" class="form-control" id="fld_needed" aria-describedby="neededHelp" placeholder="Сумма">
        <small id="neededHelp" class="form-text text-muted">Введите сумму, требуемую для осуществления Вашей мечты</small>
        @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="fld_description">Описание</label>
        <textarea name = "description" class="form-control" id="fld_description" aria-describedby="descriptionHelp" placeholder="Опишите свою мечту...">
        </textarea>
        <small id="descriptionHelp" class="form-text text-muted">Опишите, что бы Вам хотелось... И зачем :)</small>
        @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="fld_link">Ссылка на товар/услугу</label>
        <input name = "link" type="url" class="form-control" id="fld_link" aria-describedby="linkHelp" placeholder="Введите ссылку">
        <small id="linkHelp" class="form-text text-muted">Можете ввести ссылку на желаемый товар/услугу. (Не обязательно)</small>
        @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>