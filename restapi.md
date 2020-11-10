**Для получения токенов безопасности, нам нужно запустить команду:**<br>
php artisan passport:install<br>
**Получаем Client ID и Client Secret**


**1. Авторизация пользователя и получение токена**<br>
**Url:** flag.loc/oauth/token
<br>**Request-type:** POST
<br>**Body:**
```json  
{
    "username" : "email пользователя",
    "password" : "password пользователя",
    "grant_type" : "password",
    "client_id" : "client id",
    "client_secret" : "client secret",
}
```
**Response-type:** json
<br>**Response:**
```json 
{
    "token_type" : "bearer",
    "expires_in" : 31536000,
    "acces_token" : "acces_token",
    "refresh_token" : "refresh_token",
}
```
**2. Получение фильм по id**<br>
**Url: flag.loc/api/film/{id}**
<br>**Request-type:** GET
<br>**Header:** authorization = Bearer access_token
<br>**Response-type:** json
<br>**Response:** 
```json 
{
    "status": "Фильм успешно получен",
    "film" : "Информация о фильме",
}
```
**3. Получить все жанры**<br>
**Url: flag.loc/api/genres**
<br>**Request-type:** GET
<br>**Header:** authorization = Bearer access_token
<br>**Response-type:** json
<br>**Response:** 
```json 
{
    "status": "Жанры успешно получены",
    "genres" : "Информация о фильме",
}
```
**4. Добавление жанра**<br>
**Url:** flag.loc/api/genre/create
<br>**Request-type:** POST
<br>**Header:** authorization = Bearer access_token
<br>**Body:**
```json  
{
    "name" : "Название",
}
```
<br>**Response-type:** json
<br>**Response:** 
```json 
{
    "status": {
        "status": "Жанр добавлен"
    }
}
```
**5. Редактирование жанра**<br>
**Url:** flag.loc/api/genre/update/{id}
<br>**Request-type:** POST
<br>**Header:** authorization = Bearer access_token
<br>**Body:**
```json  
{
    "name" : "Название",
}
```
<br>**Response-type:** json
<br>**Response:** 
```json 
{
    "status": {
        "status": "Жанр обновлен"
    }
}
```
**6. Удаление жанра**<br>
**Url:** flag.loc/api/genre/delete/{id}
<br>**Request-type:** POST
<br>**Header:** authorization = Bearer access_token
<br>**Response-type:** json
<br>**Response:** 
```json 
{
    "status": {
        "status": "Жанр удален"
    }
}
```
**7. Получить список всех фильмов с возможностью пагинации, сортировки, фильтрации по жанру**<br>
**Url:** flag.loc/api/get/films
<br>**Request-type:** POST
<br>**Header:** authorization = Bearer access_token
<br>**Body:**
```json  
{
    "order" : "Сортировка",
    "paginate" : "Количество элементов в пагинации",
    "genres" : "Жанр",
}
```
<br>**Response-type:** json
<br>**Response:** 
```json 
{
    "status": "Фильмы успешно получены",
    "films": "Информация о фильмах",
}
```
**8. Добавление фильма**<br>
**Url:** flag.loc/api/film/create
<br>**Request-type:** POST
<br>**Body:** 
```json
{
    "name" : "Название",
    "description" : "Описание",
    "release_date" : "Дата выхода",
    "image" : "Картинка",
    "genres" : "Жанр"
}
```
<br>**Header:** authorization = Bearer access_token
<br>**Response-type:** json
<br>**Response:** 
```json 
{	
    "status": {
        "status": "Фильм добавлен"
    }
}
```
**9. Редактирование фильма**<br>
**Url:** flag.loc/api/film/update/{id}
<br>**Request-type:** POST
<br>**Body:** 
```json
{
    "name" : "Название",
    "description" : "Описание",
    "release_date" : "Дата выхода",
    "image" : "Картинка",
    "genres" : "Жанр"
}
```
<br>**Header:** authorization = Bearer access_token
<br>**Response-type:** json
<br>**Response:** 
```json 
{	
    "status": {
        "status": "Фильм обновлен"
    }
}
```
**10. Удаление фильма**<br>
**Url:** flag.loc/api/film/delete/{id}
<br>**Request-type:** POST
<br>**Header:** authorization = Bearer access_token
<br>**Response-type:** json
<br>**Response:** 
```json 
{	
    "status": {
        "status": "Фильм удален"
    }
}
```
