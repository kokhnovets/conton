@extends('layouts.base')
@section('title', 'Все сообщения обратной связи')
@section('main')
    <div class="container">
        <h3 class="h3 mb-3 mt-3">Все заявки</h3>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Тема</th>
                    <th scope="col">Сообщение</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($feedbacks as $index => $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->first_name }}</td>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->theme }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->status }}</td>
                        <td>
                            <button type="button" class="w-100 btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$index}}">
                                Ответить
                            </button>
                            <div class="modal fade" id="exampleModal{{$index}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$index}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel{{$index}}">Ответить пользователю</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="update_status{{$index}}" method="POST" novalidate>
                                                @csrf
                                                @method('PATCH')
                                                <p class="fs-6 fw-bold mb-3">Напишите ответ</p>
                                                <div class="form-floating mb-3">
                                                    <textarea maxlength="400" class="form-control message"
                                                              name="message" id="message" rows="5" style="resize: none; min-height: 100px;"
                                                              placeholder="Ответ"></textarea>
                                                    <label for="message">Ответ</label>
                                                    <span class="invalid-feedback message_error">
                                                        <strong></strong>
                                                    </span>
                                                    <p class="fs-6">Напишите сообщение пользователю, не более 400 символов.</p>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <select class="form-control status" name="status" id="status">
                                                        <option value="Заявка в работе" selected>Заявка в работе</option>
                                                        <option value="Заявка обработана">Заявка обработана</option>
                                                    </select>
                                                    <label for="status">Выберите статус заявки</label>
                                                    <span class="invalid-feedback status_error">
                                                        <strong></strong>
                                                    </span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn user-banned btn-danger">Отправить</button>
                                                </div>
                                            </form>
                                            <div class="feedback__response">
                                                <h5 class="fs-6 fw-bold mb-2">История сообщений:</h5>
                                                @foreach($feedback->responsefeedbacks as $response)
                                                    <p class="fs-6"><span class="fw-bold">{{ Jenssegers\Date\Date::parse($response->created_at)->format('j F Y г. в H:i:s')}}:</span> {{ $response->message }}</p>
                                                @endforeach
                                            </div>
                                            <script type="text/javascript">
                                                document.querySelector('.update_status{{$index}}').addEventListener('submit', function(event) {
                                                    event.preventDefault();
                                                    const formData = new FormData(this);

                                                    fetch("{{ route('admin.feedbacks.response', $feedback->id) }}", {
                                                        method: 'POST',
                                                        body: formData,
                                                        headers: {
                                                            'Accept': 'application/json',
                                                            'X-Requested-With': 'XMLHttpRequest'
                                                        }
                                                    })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            if (data.errors) {
                                                                console.log(data.errors)
                                                                Object.entries(data.errors).forEach(([key, value]) => {
                                                                    document.querySelector(`.${key}_error strong`).textContent = value;
                                                                    document.querySelector(`.${key}`).classList.add('is-invalid');
                                                                });
                                                            } else if (data.status) {
                                                                location.reload();
                                                            }
                                                        })
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
