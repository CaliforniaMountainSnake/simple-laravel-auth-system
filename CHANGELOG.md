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
