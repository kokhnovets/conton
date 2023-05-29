<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateProfileSettingsRequest;
use App\Http\Requests\Settings\UpdateSettingsDetailsRequest;
use App\Http\Requests\Settings\UpdateSettingsPhoneRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UpdateSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Сохранение настройки личной информации
    public function updateSettingsProfile(UpdateProfileSettingsRequest $request) {
        $userId = auth()->id(); // Получение идентификатора авторизованного пользователя
        $user = User::findOrFail($userId); // Поиск в БД пользователя с идентификатором
        $path = '';
        // Реализация сохранения аватарок (если есть старые, то его удалить)
        if ($request->hasFile('photo_profile_path')) {
            if ($user->photo_profile_path) Storage::delete($user->photo_profile_path);
            $path = $request->file('photo_profile_path')->store('photo_profile_paths');
        }
        $validated = $request->validated(); // Валидация полей
        $user->fill([ // Сохранение в БД провалидированных данных
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'about_me' => $validated['about_me'],
            'where_from' => $validated['where_from'],
            'where' => $validated['where'],
            'photo_profile_path' => $path ? $path : $user->photo_profile_path,
        ]);
        $user->save(); // Сохранение в БД обновленных данных
        // Перенаправление после сохранения на страницу с настройками с сообщением
        return redirect()->route('user.settings.profile')->with('message', 'Изменения успешно сохранены.');
    }
    // Сохранение настройки с деталями аккаунта
    public function updateSettingsDetails(UpdateSettingsDetailsRequest $request) {
        $userId = auth()->id(); // Получение идентификатора авторизованного пользователя
        $user = User::findOrFail($userId); // Поиск в БД пользователя с идентификатором
        $userPassword = $user->password; // Получение текущего пароля авторизованного пользователя
        $validated = $request->validated(); // Валидация данных
        if (Hash::check($validated['password'], $userPassword)) { // Проверка на совпадение с предыдущим паролем
            return back()->withErrors(['password' => 'Новый пароль не должен совпадать с предыдущим.']);
        } else {
            $user->fill([
                'email' => $validated['email'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password
            ]);
            $user->save(); // Сохранение в БД обновленных данных
        }
        // Перенаправление после сохранения на страницу с настройками с сообщением
        return redirect()->route('user.settings.details')->with('message', 'Изменения успешно сохранены.');
    }
    // Сохранение настройки телефона
    public function updateSettingsPhone(UpdateSettingsPhoneRequest $request) {
        $userId = auth()->id(); // Вывод идентификатора авторизованного пользователя
        $user = User::findOrFail($userId); // Поиск в БД пользователя
        $validated = $request->validated(); // Валидация данных
        $user->fill([
            'phone' => $validated['phone'],
        ]);
        $user->save(); // Сохранение в БД обновленных данных
        // Перенаправление после сохранения на страницу с настройками с сообщением
        return redirect()->route('user.settings.phone')->with('message', 'Изменения успешно сохранены.');
    }
}
