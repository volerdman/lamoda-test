# API для работы с товарами на складе


##Развертывание сервиса локально:

1. Склонировать проект
   1. git clone git@github.com:volerdman/lamoda-test.git
2. Склонировать .env.dist командой
   1. ```bash 
      cp .env.dist .env 
3. Запустить у себя локально докер
   1. Linux: docker run
   2. Mac OS/Windows: запустить Docker desktop
4. Для того, чтобы сразу поднять весь сервис с миграциями запустить команду
   1. ```bash 
      /usr/bin/make ./Makefile build.service ```
      
5. Поднять локально ngrok/localtunel для проксирования запросов на 8080 порте
6. Готово, сервис поднят

## Список роутов

```bash
 ---------------- -------- -------- ------ -------------------------- 
  Name             Method   Scheme   Host   Path                      
 ---------------- -------- -------- ------ -------------------------- 
  _preview_error   ANY      ANY      ANY    /_error/{code}.{_format}  
  default          GET      ANY      ANY    /                         
  storage.events   POST     ANY      ANY    /storage                  
  product.events   POST     ANY      ANY    /product                  
 ---------------- -------- -------- ------ -------------------------- 
```
## Запросы и ответы
### Запросы
1. Получение количества товаров на складе по id склада
   1. Запрос
      ```bash 
         curl --location ‘свой базовый url + эндпойнт /storage' \ 
         --header 'Content-Type: application/json' \
         --data '{
            "method": "getProductsInStorage",
            "params": {
               "id": указать id склада
            }
         }' 
      ```
   2. Результат
         ```bash 
         {
            "result": {
               "total_products_count": 365
            }
         }
         ```
2. Резервирование товаров на складе по кодам товаров
   1. Запрос
      ```bash
      curl --location 'свой базовый url + эндпойнт /product' \
      --header 'Content-Type: application/json' \
      --data '{
         "method": "reserveProducts",
         "params": {
            "code": [
               "name1", "name2"
            ]
         }
      }'
      ```
   2. Результат
   ```bash
      {
       "result": {
           "updated_products": [
               {
                   "id": 1,
                   "name": "name 1",
                   "size": 52,
                   "code": "name1",
                   "count": 78,
                   "reserved": false,
                   "storageId": 8
               },
               {
                   "id": 2,
                   "name": "name 2",
                   "size": 49,
                   "code": "name2",
                   "count": 66,
                   "reserved": false,
                   "storageId": 7
               }
           ]
       }
   }
   ```
3. Отмена резервирования товаров на складе по кодам товаров
   1. Запрос
   ```bash
      curl --location 'свой базовый url + эндпойнт /product' \
      --header 'Content-Type: application/json' \
      --data '{
         "method": "cancelProductsReservation",
         "params": {
            "code": [
               "name1", "name2"
            ]
         }
      }'
      ```
   2. Результат
   ```bash
      {
       "result": {
           "updated_products": [
               {
                   "id": 1,
                   "name": "name 1",
                   "size": 52,
                   "code": "name1",
                   "count": 78,
                   "reserved": false,
                   "storageId": 8
               },
               {
                   "id": 2,
                   "name": "name 2",
                   "size": 49,
                   "code": "name2",
                   "count": 66,
                   "reserved": false,
                   "storageId": 7
               }
           ]
       }
   }
   ```