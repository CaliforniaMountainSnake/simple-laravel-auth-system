<?php

namespace Tests\Feature;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthParamsAuthenticatorUtils;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

/**
 * Trait AbstractAuthSystemTest
 *
 * @package Tests\Feature
 */
trait AbstractAuthSystemTest
{
    use MakesHttpRequests;
    use AuthParamsAuthenticatorUtils;

    abstract protected function getRouteRoleNotAuthGetMethodOnly(): string;

    abstract protected function getRouteRoleUserGetMethod(): string;

    abstract protected function getRouteRoleAdminGetMethod(): string;

    abstract protected function getRouteAccountTypeFreeGetMethod(): string;

    abstract protected function getRouteAccountTypeNotFreeGetMethod(): string;

    abstract protected function getTokenRoleUser(): string;

    abstract protected function getTokenRoleAdmin(): string;

    abstract protected function getTokenAccountTypeFree(): string;

    abstract protected function getTokenAccountTypeNotFree(): string;

    /**
     * @return int
     */
    protected function getTokenMaxLength(): int
    {
        return 64;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testMethodNotAllowed(): void
    {
        $this->post($this->getRouteRoleNotAuthGetMethodOnly())
            ->assertStatus(JsonResponse::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testNoToken(): void
    {
        $this->get($this->getRouteRoleUserGetMethod())
            ->assertStatus(JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testBadTokenFormat(): void
    {
        // Test empty token.
        $this->get($this->getRouteRoleNotAuthGetMethodOnly() . $this->authGetParams(''))
            ->assertStatus(JsonResponse::HTTP_BAD_REQUEST);

        // Test too short token.
        $this->get($this->getRouteRoleNotAuthGetMethodOnly() . $this->authGetParams('a'))
            ->assertStatus(JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testNotValidToken(): void
    {
        // Create a token that have good length, but is not valid.
        $token = \str_pad('', $this->getTokenMaxLength(), 'd');

        $paramsString = $this->authGetParams($token);
        $this->get($this->getRouteRoleNotAuthGetMethodOnly() . $paramsString)
            ->assertStatus(JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testGoodToken(): void
    {
        $this->get($this->getRouteRoleUserGetMethod() . $this->authGetParams($this->getTokenRoleUser()))
            ->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testUnauthorized(): void
    {
        // The user is authenticated, but is unauthorized - he has not enough rights.
        $this->get($this->getRouteRoleAdminGetMethod() . $this->authGetParams($this->getTokenRoleUser()))
            ->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testPaidActionPaidUser(): void
    {
        $this->get($this->getRouteAccountTypeNotFreeGetMethod()
            . $this->authGetParams($this->getTokenAccountTypeNotFree()))
            ->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testPaidActionFreeUser(): void
    {
        $this->get($this->getRouteAccountTypeNotFreeGetMethod()
            . $this->authGetParams($this->getTokenAccountTypeFree()))
            ->assertStatus(JsonResponse::HTTP_PAYMENT_REQUIRED);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testFreeActionPaidUser(): void
    {
        $this->get($this->getRouteAccountTypeFreeGetMethod()
            . $this->authGetParams($this->getTokenAccountTypeNotFree()))
            ->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testFreeActionFreeUser(): void
    {
        $this->get($this->getRouteAccountTypeFreeGetMethod()
            . $this->authGetParams($this->getTokenAccountTypeFree()))
            ->assertStatus(JsonResponse::HTTP_OK);
    }
}
