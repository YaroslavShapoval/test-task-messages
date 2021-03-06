### Базовая функциональность
1. Сделать форму обратной связи. 
На странице должны быть показаны все оставленные отзывы, под ними форма:
- Имя
- E-mail
- Текст сообщения,
- Кнопки **Предварительный просмотр** и **Отправить**.

Отзывы можно сортировать по *имени автора*, *e-mail* и *дате добавления* (по умолчанию - по дате, последние наверху).
Также должна быть валидация.

2. Предварительный просмотр должен работать без перезагрузки страницы.
После нажатия кнопки новый отзыв должен появиться на странице под внизу под остальными.

3. Сделать вход для администратора (логин `admin`, пароль `123`).
Администратор должен иметь возможность редактировать отзыв.
Измененные отзывы в общем списке выводятся с пометкой "изменен администратором".

В приложении нужно с помощью чистого PHP реализовать модель MVC (PHP-фреймворки использовать нельзя).

Верстка на bootstrap.

Не забывайте об аккуратности задания - это очень важно.

Приложение нужно развернуть на любом бесплатном хостинге, чтобы можно было посмотреть его в действии.
Скопируйте в папку с кодом наш онлайн-редактор [dayside](https://github.com/boomyjee/dayside) (в корень проекта).
Он должен быть доступен по url `<ваш проект>/dayside/index.php`
Пожалуйста, проверьте, чтоб все открывалось.

Если вы совсем начинающий программист, на этом можно остановиться.
Будет здорово, если вы выполните все задания с дополнениями.

### Дополнения
4. К отзыву можно прикрепить картинку.
Картинка должна быть не более 320х240 пикселей.
При попытке залить изображение большего размера, картинка должна быть пропорционально уменьшена до заданных размеров.
Допустимые форматы: JPG, GIF, PNG.

5. У администратора должна быть возможность модерирования.
Т.е. на странице администратора показаны отзывы с миниатюрами картинок и их статусы (принят/отклонен).
Отзыв становится видимым для всех только после принятия админом.
Отклоненные отзывы остаются в базе, но не показываются обычным пользователям.
Изменение картинки администратором не требуется.