<form action = "{{ route('pay_dream', [$dream->id]) }}" method = "post">
    @csrf
    <button type="submit" class="btn btn-primary">оплатить</button>
</form>