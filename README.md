<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Client Management Rest API

Client Management Rest API documentation.

- [Clients](##clients)
    - [Create](###create-client)
    - [Read](###read-client)
    - [Update](###update-client)
    - [Delete](###delete-client)
- [Travels](##travels)
    - [Create](###create-travel)
    - [Read](###read-travels-list)

## Clients

### Create Client

`POST /client/create`

`Content-Type: application/json`

#### Body

- `name`: String. Optional.
- `lastname`: String. Optional.
- `cellphone`: String. Optional.
- `email`: String. Required.
- `address`: String. Optional.
- `image`: File. Optional.

#### Example Request

```json
{
	"name": "Name",
	"lastname": "LastName",
	"cellphone": "+573079573640",
	"email": "example@email.com",
	"address": "Example address",
	"image": "File",
}
```

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    },
    "data": {
        "status": 1,
        "photo": "/images/users/1620610426image.jpg",
        "name": "Jane",
        "lastname": "Doe",
        "cellphone": "3119991111",
        "email": "Jane.Doe@gmail.com",
        "address": "",
        "updated_at": "2021-05-10T01:33:46.000000Z",
        "created_at": "2021-05-10T01:33:46.000000Z",
        "id": 1
    }
}
```

### Read Client

`GET /getClients/{id?}`

`Content-Type: application/json`

#### Parameters

- `id`: User identifier.

#### Example Request

`GET /getClients/1092`

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    },
    "data": {
        "id": 1,
        "name": "Jane",
        "lastname": "Doe",
        "cellphone": "3119991111",
        "email": "Jane.Doe@gmail.com",
        "address": "",
        "photo": null,
        "created_at": "2021-05-08T22:19:53.000000Z",
        "updated_at": "2021-05-08T22:21:49.000000Z",
        "status": 1
    }
}
```


### Search Client

`POST /clientFilters`

`Content-Type: application/json`
 
#### Example Request

`POST /clientFilters`

#### Body

- `name`: String. Optional.
- `email`: String. Optional.
- `phone`: String. Optional.  

#### Example Request

```json
{ 
    "name" : "J",
    "lastname" : "",
    "phone" : "",  
}
```

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    },
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 10,
                "name": "Jane",
                "lastname": "Doe",
                "cellphone": "3119991111",
                "email": "Jane.Doe@gmail.com",
                "address": null,
                "photo": null,
                "created_at": "2021-05-10T02:11:26.000000Z",
                "updated_at": "2021-05-10T02:11:26.000000Z",
                "status": 1
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/clientFilters?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/clientFilters?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/clientFilters?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/clientFilters",
        "per_page": 20,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}

```

### Update Client

`POST /updateClient`

`Content-Type: application/json`
 
#### Body

- `name`: String. Optional.
- `lastname`: String. Optional.
- `cellphone`: String. Optional. 
- `address`: String. Optional.
- `image`: File. Optional.

#### Example Request

```json
{
    "id" : 1,
    "name" : "John",
    "lastname" : "Doe",
    "cellphone" : "5556664433", 
    "address" : "Avenue 15 "
}
```

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    },
    "data": {
        "id": 1,
        "name": "John",
        "lastname": "Doe",
        "cellphone": "5556664433",
        "email": "John.Doe@gmail.com",
        "address": "Avenue 15",
        "photo": null,
        "created_at": "2021-05-08T22:19:53.000000Z",
        "updated_at": "2021-05-10T01:59:58.000000Z",
        "status": 0
    }
}
```

### Delete Client

`DELETE /deleteClient/{id}`

`Content-Type: application/json`

#### Parameters

- `id`: User identifier.

#### Example Request

`DELETE /deleteClient/8`

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    }
}
```

## Travels


### Create Travel

`POST /createTravelXML`

`Content-Type: application/xml`

#### Body

- `date`: String. Required.
- `country`: String. Required.
- `city`: String. Required.
- `email_fk`: String. Required.

#### Example Request

```xml
<?xml version="1.0" ?>
<travel>    
    <email_fk>Jane.Doe@gmail.com</email_fk>  
    <date>01/01/1999</date>  
    <country>Colombia</country>  
    <city>Bogota</city>  
</travel>
```

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    },
    "data": {
        "id": 7,
        "email_fk": "Jane.Doe@gmail.com",
        "date": "01/01/1999",
        "country": "Colombia",
        "city": "Bogota",
        "status": 1,
        "created_at": "2021-05-10T02:14:17.000000Z",
        "updated_at": "2021-05-10T02:14:17.000000Z"
    }
}
```

### Read Travels List

`GET /getTravel`

`Content-Type: application/json`

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    },
    "data": [ 
        {
            "id": 4,
            "email_fk": "John.Doe@gmail.com",
            "date": "31/12/1999",
            "country": "Colombia",
            "city": "Barranquilla",
            "status": 1,
            "created_at": "2021-05-09T05:17:05.000000Z",
            "updated_at": "2021-05-09T05:17:05.000000Z"
        },
        {
            "id": 7,
            "email_fk": "Jane.Doe@gmail.com",
            "date": "01/01/1999",
            "country": "Colombia",
            "city": "Bogota",
            "status": 1,
            "created_at": "2021-05-10T02:14:17.000000Z",
            "updated_at": "2021-05-10T02:14:17.000000Z"
        }
    ]
}
```

### Search Travels 

`GET /getTravelFilters`

`Content-Type: application/json`

#### Body

- `email`: String. Optional.
- `date`: String. Optional. 
- `country`: String. Optional.
- `city`: File. Optional.

#### Example Request

```json
{
    "email" : "",
    "date":"",
    "country":"",
    "city":"Bo" 
}
```

#### Example Response

`200 OK`

```json
{
    "status": {
        "code": 1,
        "message": "Procesado con éxito"
    },
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 7,
                "email_fk": "Jane.Doe@gmail.com",
                "date": "01/01/1999",
                "country": "Colombia",
                "city": "Bogota",
                "status": 1,
                "created_at": "2021-05-10T02:14:17.000000Z",
                "updated_at": "2021-05-10T02:14:17.000000Z"
            },
            {
                "id": 9,
                "email_fk": "John.Doe@gmail.com",
                "date": "01/01/1999",
                "country": "Colombia",
                "city": "Bogota",
                "status": 1,
                "created_at": "2021-05-10T02:23:04.000000Z",
                "updated_at": "2021-05-10T02:23:04.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/getTravelFilters?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/getTravelFilters?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/getTravelFilters?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/getTravelFilters",
        "per_page": 20,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
}
```