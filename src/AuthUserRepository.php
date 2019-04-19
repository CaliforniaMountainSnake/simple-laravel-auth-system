<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

use CaliforniaMountainSnake\DatabaseEntities\BaseRepository;

abstract class AuthUserRepository extends BaseRepository
{
    abstract public function getByApiToken(string $_api_token): ?AuthUserEntity;
}
