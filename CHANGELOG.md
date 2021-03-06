# Changelog
The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security


## [3.0.19] - 2020-04-20
### Changed
- AvailableRoutes::getAvailableRoutes() has been renamed to AvailableRoutes::getUserAvailableRoutes().

## [3.0.18] - 2020-04-20
### Changed
- ActionsApiEndpoints is a BuiltinApiEndpoints trait now.

## [3.0.17] - 2020-04-20
### Added
- Added AuthUserAvailableActions::toArray() method.
- Added helper traits with actions for using in the controller.

## [3.0.16] - 2020-04-19
### Added
- Added AuthUserAvailableActions::toJson() method.

## [3.0.15] - 2020-04-17
### Added
- Added the possibility to set a hash function for api_token request param.
### Changed
- Added the support of laravel framework 6 and 7.

## [3.0.14] - 2020-01-26
### Fixed
- README.md has been improved.

## [3.0.13] - 2020-01-22
### Added
- Added the FullRequest class that contains also route parameters.

## [3.0.12] - 2020-01-22
### Removed
- Removed the test of empty token from the AbstractAuthSystemTest::testBadTokenFormat(). Because this test is depends on Laravel's ConvertEmptyStringsToNull middleware class, but is not mandatory.

## [3.0.11] - 2020-01-18
### Fixed
- Fixed TestControllerApiEndpoints.

## [3.0.10] - 2020-01-18
### Fixed
- Fixed TestControllerApiEndpoints.

## [3.0.9] - 2020-01-18
### Changed
- ControllerTestActions had been renamed to TestControllerActions.

## [3.0.8] - 2020-01-18
### Fixed
- Fixed a bug in the AbstractAuthSystemTest.

## [3.0.7] - 2020-01-18
### Added
- Added the MustHasUser and MustHasAuthenticator traits.
### Changed
- AbstractAuthSystemTest has been simplified.

## [3.0.6] - 2020-01-15
### Fixed
- Fixed a bug with the AuthenticationException::fromMessages().

## [3.0.5] - 2020-01-15
### Changed
- The AbstractAuthSystemTest trait has been replaced into CaliforniaMountainSnake\SimpleLaravelAuthSystem\TestUtils namespace.

## [3.0.4] - 2020-01-14
### Fixed
- Updated README.md.

## [3.0.3] - 2020-01-14
### Fixed
- Added the creation of singleton instance in the AuthMiddleware.

## [3.0.2] - 2020-01-14
### Fixed
- AuthMiddleware now creates BasicHttpAuthenticator directly instead of calling app()->make().

## [3.0.1] - 2020-01-14
### Fixed
- In the AuthApiUserController interface resolving has been replaced into the middleware to allow AuthMiddleware do its job and create a UserEntity.

## [3.0.0] - 2020-01-13
### Added
- Added the AbstractAuthSystemTest trait that can be used to test auth system on the project.
### Changed
- The logic of authentication has been replaced from middleware into the separate class.

## [2.2.7] - 2020-01-11
### Fixed
- Fixed a bug with AuthParamsAuthenticatorUtils. It was a class, not trait)

## [2.2.6] - 2020-01-11
### Added
- Added AuthParamsAuthenticatorUtils trait that can be used in tests for authorize request params for perform requests to protected routes.

## [2.2.5] - 2020-01-11
### Fixed
- Fixed security vulnerabilities founded by GitHub in dependencies.

## [2.2.4] - 2019-07-29
### Added
- Added AuthUserRoleAccessUtils and AuthUserAccountTypeAccessUtils traits into the AuthApiUserController.

## [2.2.3] - 2019-07-29
### Fixed
- Fixed the README.md.

## [2.2.2] - 2019-07-28
### Fixed
- Fixed the bug.

## [2.2.1] - 2019-07-28
### Changed
- Added the possibility to allow cross-origin requests for the each route in the AuthRoleService class.

## [2.2.0] - 2019-07-27
### Added
- Added the AuthValidatorService abstract class.
- Added makeValidator() method in the AuthValidatorServiceInterface.
### Changed
- README.md was modified to be compatible with new changes.

## [2.1.0] - 2019-07-27
### Added
- Added classes intended to work with laravel controllers.
- Added CorsMiddleware.
### Changed
- Changed the namespace of the AuthMiddleware class.
- README.md was modified to be compatible with new changes.

## [2.0.5] - 2019-07-21
### Fixed
- Fixed the bug.

## [2.0.4] - 2019-07-21
### Added
- Added methods AuthUserRoleAccessUtils::getRoleOfUserString and AuthUserAccountTypeAccessUtils::getAccountTypeOfUserString.

## [2.0.3] - 2019-07-18
### Fixed
- Fix some other bugs.

## [2.0.2] - 2019-07-17
### Fixed
- Fix some bug.

## [2.0.1] - 2019-07-17
### Added
- Added methods AuthRoleService::getRolesByRoute() and AuthRoleService::getAccountTypesByRoute(). 

## [2.0.0] - 2019-07-17
### Added
- Added this changelog.
### Changed
- Big unification of some classes and methods.
- Updated the Composer dependencies.

[3.0.19]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.18...3.0.19
[3.0.18]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.17...3.0.18
[3.0.17]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.16...3.0.17
[3.0.16]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.15...3.0.16
[3.0.15]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.14...3.0.15
[3.0.14]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.13...3.0.14
[3.0.13]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.12...3.0.13
[3.0.12]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.11...3.0.12
[3.0.11]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.10...3.0.11
[3.0.10]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.9...3.0.10
[3.0.9]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.8...3.0.9
[3.0.8]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.7...3.0.8
[3.0.7]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.6...3.0.7
[3.0.6]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.5...3.0.6
[3.0.5]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.4...3.0.5
[3.0.4]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.3...3.0.4
[3.0.3]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.2...3.0.3
[3.0.2]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.1...3.0.2
[3.0.1]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.0...3.0.1
[3.0.0]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/2.2.7...3.0.0
