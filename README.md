<h1 align="center">Magento 2 SysConfig</h1>
<br />

The `Iods_SysConfig` module is a configuration management framework for the Magento 2 admin.

Functionality provided by this module include:
 * CRUD operations for modules to utilize
 * Custom field models and templates for additional field types
 * Grid examples for displaying existing data
 * Extends the config key options available to the GraphQL endpoints


Table of Contents
-----------------

 1. [Facts](#facts)
 2. [Getting Started](#getting-started)
 3. [Coding Style and Standards](#coding-style-and-standards)
 4. [Development](#development)
 5. [Extensibility](#extensibility)
 6. [Configurations](#configurations)
 7. [UI Components](#ui-components)
 8. [Tests](#tests)
 9. [Deployment](#deployment)
 10. [Further Reading](#further-reading)
 11. [License](#license)
 12. [Copyright](#copyright)

Facts
-----

 * Version 000.1.1


### Requirements

 * PHP Version 8.1
 * Magento 2.4.5-p1

### Compatibility

Works with all other ioDS modules. Can be extended from.


Getting Started
---------------

### Usage Instructions

### Known Issues

### Related Tasks and Discussions

### Installation

```shell
$ mkdir
```

### Uninstallation

```shell
$ rmdir
```


Coding Style and Standards
--------------------------


Development
-----------

#### Approach

### Components

#### Service Contracts

#### Models

##### API Models

##### Resource Models

#### Controllers

### Plugins

### etc


Extensibility
-------------

##### Events

##### Layouts


Configurations
--------------

Configuration options available from the module.

| Section   | Group     | Field  | Type | Description |
|---|---|---|---|---|
| `iods_base` | sysconfig | `enable` | select | Enables and disables the module (enabled by default). |


UI Components
-------------


Tests
-----


Deployment
----------

### Configurations



Further Reading
---------------


License
-------
[![MIT Licence](https://badges.frapsoft.com/os/mit/mit.svg?v=103)](https://opensource.org/licenses/mit-license.php)


Copyright
---------
(c) 2022, Rye Miller