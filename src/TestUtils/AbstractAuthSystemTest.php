<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\TestUtils;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthParamsAuthenticatorUtils;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

/**
 * This trait helps to create a full test of authorization system on the project.
 */
trait AbstractAuthSystemTest
{
    use MakesHttpRequests;
    use AuthParamsAuthenticatorUtils;
    use TestControllerApiEndpoints;
    use RequireAdminRoles;

    /**
     * @param string $_test_api_endpoint
     *
     * @return mixed
     */
    abstract protected function getTestControllerApiRouteByEndpoint(string $_test_api_endpoint);

    abstract protected function getTokenLength(): int;

    abstract protected function getTokenRoleAuthenticatedUser(): string;

    abstract protected function getTokenRoleAdminUser(): string;

    abstract protected function getTokenAccountTypeFreeUser(): string;

    abstract protected function getTokenAccountTypeNotFreeUser(): string;

    /**
     * @throws InvalidArgumentException
     */
    public function testMethodNotAllowed(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_FOR_ALL_USERS());
        $this->post($route)
            ->assertStatus(JsonResponse::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testBadTokenFormat(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_ONLY_FOR_AUTHORIZED_USERS());

        // No token.
        $this->get($route)
            ->assertStatus(JsonResponse::HTTP_BAD_REQUEST);

        // Empty token.
        $this->get($route . $this->authGetParams(''))
            ->assertStatus(JsonResponse::HTTP_BAD_REQUEST);

        // Too short token.
        $this->get($route . $this->authGetParams('a'))
            ->assertStatus(JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testNotValidToken(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_ONLY_FOR_AUTHORIZED_USERS());
        $invalidToken = \str_pad('', $this->getTokenLength(), 'd');

        // The token has a correct format, but doesn't exist.
        $this->get($route . $this->authGetParams($invalidToken))
            ->assertStatus(JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testAuthenticated(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_ONLY_FOR_AUTHORIZED_USERS());

        // Test authentication of an usual user.
        $this->get($route . $this->authGetParams($this->getTokenRoleAuthenticatedUser()))
            ->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testAuthorized(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_ONLY_FOR_AUTHORIZED_USERS());

        // Test authentication AND AUTHORISATION of an admin user (The user is allowed the the requested route).
        $this->get($route . $this->authGetParams($this->getTokenRoleAdminUser()))
            ->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testUnauthorized(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_ONLY_FOR_ADMIN_USERS());

        // The user is authenticated, but is unauthorized - he doesn't have enough rights.
        $this->get($route . $this->authGetParams($this->getTokenRoleAuthenticatedUser()))
            ->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testPaidActionFreeUser(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_ONLY_FOR_NOT_FREE_USERS());
        $this->get($route . $this->authGetParams($this->getTokenAccountTypeFreeUser()))
            ->assertStatus(JsonResponse::HTTP_PAYMENT_REQUIRED);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testPaidActionPaidUser(): void
    {
        $route = $this->getTestControllerApiRouteByEndpoint($this->TEST_ACTION_ONLY_FOR_NOT_FREE_USERS());
        $this->get($route . $this->authGetParams($this->getTokenAccountTypeNotFreeUser()))
            ->assertStatus(JsonResponse::HTTP_OK);
    }
}
