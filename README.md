# Post-Comment API Projects
The experimental Laravel project to build an API that used to do the operations like Create Read Update and Delete (CRUD) data on database. This project using post-comment as case study to implements the operations, and will add some general features to it.


## Endpoints List

| No. | Method | Endpoint | Description |
| --- | ------ | -------- | ----------- |
| 1 | GET | /api/posts | Get All Post |
| 2 | GET | /api/posts/5 | Get Specified Post |
| 3 | POST | /api/posts | Add New Post |
| 4 | PUT | /api/posts/5 | Update Specified Post |
| 5 | DELETE | /api/posts/5 | Delete Specified Post |
| 6 | GET | /api/posts/5/comments | Get All Comments From Specified Post |
| 7 | GET | /api/posts/5/comments/1 | Get Specified Comments From Specified Post |
| 8 | POST | /api/posts/5/comments | Add New Comment To Specified Post |
| 9 | PUT | /api/posts/5/comments/1 | Update Specified Comment From Specified Post |
| 10 | DELETE | /api/posts/5/comments/1 | Delete Specified Comment Specified Post |


## Implemented Features

- [X] Data Request
- [X] CRUD operations
- [X] Nested Parameter
- [X] Resources
- [X] Form Validation
- [X] Form Request
- [] Authentication (API Token with Sanctum)
- [] Authorization
- [] Middleware
- [] Testing
- [] File Handling (Image)
- [] Payment Gateway