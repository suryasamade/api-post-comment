# Post-Comment API Projects

The experimental Laravel project to build an API that used to do the operations like Create Read Update and Delete (CRUD) data on database. This project using post-comment as case study to implements the operations, and will add some general features to it.

## Endpoints List

| No. | Method | Endpoint                                 | Description                                  |
| --- | ------ | ---------------------------------------- | -------------------------------------------- |
| 1   | GET    | /api/posts                               | Get All Post                                 |
| 2   | GET    | /api/posts/{id}                          | Get Specified Post                           |
| 3   | POST   | /api/posts                               | Add New Post                                 |
| 4   | PUT    | /api/posts/{id}                          | Update Specified Post                        |
| 5   | DELETE | /api/posts/{id}                          | Delete Specified Post                        |
| 6   | GET    | /api/posts/{postId}/comments             | Get All Comments From Specified Post         |
| 7   | GET    | /api/posts/{postId}/comments/{commentId} | Get Specified Comments From Specified Post   |
| 8   | POST   | /api/posts/{postId}/comments             | Add New Comment To Specified Post            |
| 9   | PUT    | /api/posts/{postId}/comments/{commentId} | Update Specified Comment From Specified Post |
| 10  | DELETE | /api/posts/{postId}/comments/{commentId} | Delete Specified Comment Specified Post      |

## Implemented Features

-   [x] Data Request
-   [x] CRUD operations
-   [x] Nested Parameter
-   [x] Resources
-   [x] Form Validation
-   [x] Form Request
-   [x] Authentication (API Token with Sanctum)
-   [] Authorization
-   [] Pagination
-   [] Middleware
-   [] Testing
-   [] File Handling (Image)
-   [] Payment Gateway
-   [x] OpenAPI Documentations
