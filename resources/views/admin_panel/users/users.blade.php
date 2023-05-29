@extends('layouts.base')
@section('title', 'Панель администратора: пользователи')
@section('main')
    <div class="container">
        <h3 class="h3 mb-3 mt-3">Все пользователи</h3>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Номер телефона</th>
                    <th scope="col">Удален ли аккаунт</th>
                    <th scope="col">Бан</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ? $user->phone : 'Отсутствует' }}</td>
                        <td>
                            @if($user->deleted_at)
                                Да
                            @else
                                Нет
                            @endif
                        </td>
                        <td>
                            @if($user->banned_at)
                                @if($user->bans->first()->expired_at)
                                    До {{ Jenssegers\Date\Date::parse($user->bans->first()->expired_at)->format('j F Y г.')}}
                                @else
                                    Перманентный
                                @endif

                            @else
                                Отсутствует
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.users.detail', $user->id) }}">Подробнее</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
