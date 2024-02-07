<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi="3.0.0",
 * @OA\Info(
 *      title="Swagger PostComments - OpenAPI 3.0",
 *      version="1.0.0",
 *      description="This is a sample Pet Store Server based on the OpenAPI 3.0 specification.  You can find out more about\nSwagger at [https://swagger.io](https://swagger.io). In the third iteration of the pet store, we've switched to the design first approach!\nYou can now help us improve the API whether it's by making changes to the definition itself or to the code.\nThat way, with time, we can improve the API in general, and expose some of the new features in OAS3.\n\n_If you're looking for the Swagger 2.0/OAS 2.0 version of PostComments, then click [here](https://editor.swagger.io/?url=https://PostComments.swagger.io/v2/swagger.yaml). Alternatively, you can load via the `Edit > Load PostComments OAS 2.0` menu option!_\n\nSome useful links:\n- [The Pet Store repository](https://github.com/swagger-api/swagger-PostComments)\n- [The source API definition for the Pet Store](https://github.com/swagger-api/swagger-PostComments/blob/master/src/main/resources/openapi.yaml)",
 *      termsOfService="http://swagger.io/terms/",
 *      @OA\Contact(
 *          name="API Support",
 *          url="https://www.example.com/support",
 *          email="apiteam@swagger.io"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      ),
 * ),
 * @OA\Tags(
 *      @OA\Tag(
 *          name="Post",
 *          description="Access to Post",
 *          @OA\ExternalDocumentation(url="http://swagger.io",description="Find out more about Post")
 *      ),
 *      @OA\Tag(
 *          name="Comment",
 *          description="Everything about Comments of Post",
 *          @OA\ExternalDocumentation(url="http://swagger.io",description="Find out more about Comment")
 *      ),
 *      @OA\Tag(
 *          name="Authorization",
 *          description="Operations about user",
 *      ),
 * ),
 * @OA\Components(
 * ),
 * @OA\SecurityScheme(
 *      securityScheme="post_auth",
 *      type="oauth2",
 *      @OA\Flow(
 *          flow="implicit",
 *          authorizationUrl="https://petstore3.swagger.io/oauth/authorize",
 *          scopes={
 *              "write:posts"="modify posts in your account",
 *              "read:posts"="read your posts"
 *          }
 *      ),
 * ),
 * @OA\SecurityScheme(
 *      type="apiKey",
 *      securityScheme="api_key",
 *      in="header"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
