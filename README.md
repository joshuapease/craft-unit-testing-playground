# Craft Unit Testing Playground

## Documentation

- [Setup](/docs/setup.md)
- [Running the App](/docs/running-the-app.md)

## Introduction

This repo is all about running tests! Once you set up and run the app, you can run Codeception commands like so.

```
bin/codecept run unit

bin/codecept run functional
```

## Unit Testing Concepts

### 01. Creating Structure Fixtures

In order to create and save structure entries in the correct order, you need multiple Entry fixtures that are dependant on each other.

**Fixtures:**

- [tests/fixtures/StructureFixture.php](tests/fixtures/StructureFixture.php)
- [tests/fixtures/StructureGrandparentFixture.php](tests/fixtures/StructureGrandparentFixture.php)
- [tests/fixtures/StructureParentFixture.php](tests/fixtures/StructureParentFixture.php)

**Test Files**

- [tests/unit/GetBreadcrumbsFromAncestorsTest.php](tests/unit/GetBreadcrumbsFromAncestorsTest.php)

**Test commands**

```
bin/codecept run unit:GetBreadcrumbsFromAncestorsTest
```
