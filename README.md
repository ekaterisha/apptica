# apptica

Задание:

Реализовать модуль Application Top Category Positions – получение данных о позициях приложения в топе по категориям за определенный день.

Базовый функционал:

Сбор и сохранение prepared данных для endpoint-а.
Endpoint для получения позиций в топ чарте маркета по категориям.

Дополнительный функционал: (по желанию)

Добавить ограничение по количеству запросов на endpoint с одного ip-адреса: 5 запросов в минуту.
Добавить логирование запросов на endpoint.

Технические требования:

Модуль необходимо написать на любом PHP MVC фреймворке или на чистом PHP (желательно версии 7.*) с использованием ООП, MVC.
Формат ответа endpoint – json
Для хранения prepared данных можете использовать любую DBMS.
Результат - ссылка на репозиторий с кодом.

Пример требуемого endpoint:

Запрос на ваш endpoint должен принимать только 1 параметр: день выборки, пример:
http://<ваш домен>/appTopCategory?date=2020-12-01
В ответе вашего endpoint должна быть информация с позициями приложения в топе по категориям для запрашиваемой даты

Технические данные для выполнения задания:

Apptica endpoint для загрузки данных:

https://api.apptica.com/package/top_history/1421444/1?date_from=2020-12-20&date_to=2020-12-22&B4NKGg=fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l

формат:

https://api.apptica.com/package/top_history/{{applicationId}}/{{countryId}}?date_from={{dateFrom}}&date_to={{dateTo}}&B4NKGg=fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l

параметры:

applicationId – уникальный идентификатор приложения, в тестовом задании его значение 1421444 (это приложение Among Us)
countryId – уникальный идентификатор страны, в тестовом задании его значение 1 (United States)
dateFrom, dateTo – период выгрузки (Данные доступны за последние 30 дней.)


!!! примечание !!!:

Значение позиции в топе (position) для категории (category) необходимо брать самое максимальное (минимальное число).
При расчете максимальной позиции в рамках категории подкатегории не учитываются. Объяснение на примере выше: для category == 2 мы имеем позиции 1, 1, 1, 147, 149, 150. Берем из этих позиций минимальное число 1 (максимальная позиция).