# Simple Api
the api usage data by json file with out connect to database

## system requirement
- PHP


# Usage
You can do all CRUD (Create, Read, Update, Delete) operations and one extra List operation. Here is how:

### List

List all records of a database table.

```
GET http://localhost/resful/index.php
```

Output:

```
{"status_code":200,"status":"ok","data":{"1":{"title":"Earth Task","description":"earth Task","status":"waiting"}
```
### Retrive record by id

Get record using task id

```
GET http://localhost/resful/index.php/1
```

Output:

```
{"status_code":200,"status":"ok","data":{"title":"Subject","description":"Datail","status":"waiting"}}
```

### Create

You can easily add a record using the POST method with JSON object in the body. The call returns the "last insert id".

```
curl -X POST  -d '{"title":"Go to Shopping","description":"Go to Shopping in JJ Green and get there by motorcycle"}' "http://localhost/restful/index.php"
```

Output:

```
{
  "status_code": 200,
  "status": "true",
  "data": 13
}
```


### Update

Editing a record is done with the PUT method. The call returns the rows affected.

```
curl -X PUT  -d '{"title":"Earth","description" : "Earth"}' "http://localhost/restful/index.php/1"
```

Output:

```
{
  "status_code": 200,
  "status": "ok",
  "data": "1"
}
```
### Change Task status

change task status is done with the PUT method if  data status that is done then record change to pending
```
curl -X PUT  "http://localhost/restful/index.php/status"
```

Output:

```
{
  "status_code": 200,
  "status": "ok",
  "data": "1"
}
```
### Delete

The DELETE verb is used to delete a record. The call returns the rows affected.

```
curl -X DELETE  "http://localhost/restful/index.php/1"
```

Output:

```
{
  "status_code": 200,
  "status": "ok",
  "data": "1"
}
```