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

[3.0.3]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.2...3.0.3
[3.0.2]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.1...3.0.2
[3.0.1]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/3.0.0...3.0.1
[3.0.0]: https://github.com/CaliforniaMountainSnake/simple-laravel-auth-system/compare/2.2.7...3.0.0
