# simple-laravel-auth-system
A simple realisation of authentication and authorization for Laravel

## Install:
### Require this package with Composer
Install this package through [Composer](https://getcomposer.org/).
Edit your project's `composer.json` file to require `californiamountainsnake/simple-laravel-auth-system`:
```json
{
    "name": "yourproject/yourproject",
    "type": "project",
    "require": {
        "php": "^7.2",
        "californiamountainsnake/simple-laravel-auth-system": "*"
    }
}
```
and run `composer update`

### or
run this command in your command line:
```bash
composer require californiamountainsnake/simple-laravel-auth-system
```

## Usage:
1. Extend Enum classes: (`AuthLangsEnum`, `AuthUserAccountTypeEnum`, `AuthUserRoleEnum`).
2. Extend the `AuthUserAvailableActions` class. You can add there any checks based on some user, like `(new UserAvailableActions($user))->isSomeActionAvailableForThisUser()`.  
3. Extend the `AuthUserEntity` class. This your main user class. See https://github.com/CaliforniaMountainSnake/php-database-entities.
4. Extend the `AuthUserRepository` class. This is the repository contains all user database queries in any from. See https://github.com/CaliforniaMountainSnake/php-database-entities.
5. Extend the `AuthValidatorService` class contains the Laravel validation array for `api_token` request param. Like:
```php
<?php
class MyValidatorService extends AuthValidatorService
{
    public function api_token(): array
        {
            return [
                AuthMiddleware::API_TOKEN_REQUEST_PARAM => [
                    'min:64',
                    'max:64',
                ]
            ];
        }
}
```
6. Add some binding in Laravel `AppServiceProvider`: 
```php
<?php
class AppServiceProvider extends ServiceProvider
{    
    public function boot (): void {
        $this->app->singleton(AuthRoleService::class, static function () {
            return new AuthRoleService(true);
        });
    }

    public function register(): void {
        // Binding Interfaces To Implementations.
        $this->app->singleton(AuthenticatorInterface::class, BasicHttpAuthenticator::class);
        $this->app->singleton(AuthValidatorServiceInterface::class, YourValidatorService::class);
        $this->app->singleton(AuthUserRepository::class, YourUserRepository::class);
    }
}
```
7. Extend the `AuthApiUserController` class and create your own base api controller. Realise the abstract methods.
All actions of this controller (and it's children) will be automatic handled by the auth system.
```php
<?php
class ApiUserController extends AuthApiUserController
{
    // Realise the abstract methods.
}
```

8. Now you can add your routes into the `www/routes/api.php` file like this:
```php
<?php
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthRoleService;

/** @var AuthRoleService $roleService */
$roleService = app()->make(AuthRoleService::class);

$roleService->setRote(
    Route::post('/users', 'User\UserController@createUser'),
    [
        UserRoleEnum::NOT_AUTH()
    ],
    [
        UserAccountTypeEnum::FREE(),
        UserAccountTypeEnum::PAID(),
    ]);

$roleService->setRote(
    Route::get('/users', 'User\UserController@getAllUsers'),
    [
        UserRoleEnum::TECHNICAL_ADMIN(),
        UserRoleEnum::ADMIN()
    ],
    [
        UserAccountTypeEnum::FREE(),
        UserAccountTypeEnum::PAID(),
    ]);
```
9. Catch the `MethodNotAllowedException` in the `App\Exceptions\Handler::render()`:
```php
<?php
use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler {
    /**
     * Render an exception into an HTTP response.
     *
     * @param Request   $request
     * @param Exception $exception
     *
     * @return Response
     * @throws BindingResolutionException
     * @throws InvalidArgumentException
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof MethodNotAllowedException || $exception instanceof MethodNotAllowedHttpException) {
            return JsonResponse::error([__('auth_middleware.method_not_allowed')],
                JsonResponse::HTTP_METHOD_NOT_ALLOWED)
                ->withCors()// Optional.
                ->make();
        }

        return parent::render($request, $exception);
    }
}
```
10. Create a language file (`/resources/lang/en/auth_middleware.php`) with api error messages:
- auth_middleware.method_not_allowed
- auth_middleware.no_token_error
- auth_middleware.bad_token_error
- auth_middleware.wrong_role_error
- auth_middleware.wrong_account_type_error
11. That's all)
