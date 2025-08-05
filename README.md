# Secret Server Coding Task

A feladatot Renderen keresztül hostolom Docker segítségével.
A hostolt oldal URL-je: https://secret-server-7kty.onrender.com/
A titkos üzenetet Postman segítségével a következő módon lehet például létrehozni:
```
POST https://secret-server-7kty.onrender.com/secret
{
    "secret": "Ez itt egy üzenet",
    "expireAfterViews": 3,
    "expireAfterTime": 10
}
```
A titkos üzenetet pedig a kapott hash kóddal így lehet elérni:
```
GET https://secret-server-7kty.onrender.com/secret/{hash}
További Header hozzáadható, hogy XML-ben vagy JSON-ben szeretnénk kérni a választ.
Példa egy JSON válaszra:
{
    "id": 49,
    "hash": "d067ed26f6c80868cea6858fe5a5f4c4151bd7e1b8b5279bd81f4e8546873d1a",
    "secret_text": "Ez itt egy üzenet",
    "expire_after_views": 3,
    "expire_after_time": 10,
    "created_at": "2025-08-05 22:40:12"
}
```
