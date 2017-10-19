@extends('index')

@section('head')
    @parent
@endsection
@section('main')
    <main>
        <section class="contact">
            <div class="container">
                <form action="{{ route('sendForm') }}" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <h1>Связаться с нами</h1>
                    <input type="text" name="name" value="{{ old('name') }}" class="name"
                           placeholder="Введите имя" required maxlength="100" pattern="[a-zA-ZА-Яа-я]+">
                    <input type="text" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" name="phone" placeholder="050-121-34-57" />
                    <input type="email" name="email" value="{{ old('email') }}" class="email"
                           placeholder="Введите email" required>
                    <textarea name="comment"
                              placeholder="Введите текст сообщения" maxlength="100" required>{{ old('comment') }} </textarea>
                    <input type="submit" value="Отправить">
                </form>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection