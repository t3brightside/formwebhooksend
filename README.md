# Form Webhook Send
[![License](https://poser.pugx.org/t3brightside/formwebhooksend/license)](LICENSE.txt)
[![Packagist](https://img.shields.io/packagist/v/t3brightside/formwebhooksend.svg?style=flat)](https://packagist.org/packages/t3brightside/formwebhooksend)
[![Downloads](https://poser.pugx.org/t3brightside/formwebhooksend/downloads)](https://packagist.org/packages/t3brightside/formwebhooksend)
[![Brightside](https://img.shields.io/badge/by-t3brightside.com-orange.svg?style=flat)](https://t3brightside.com)

**TYPO3 CMS extension to add webhook send finisher to forms.**

## Features
- Webhook URL
- API token (stored in form definition file for now = NOT SECURE)
- Add custom values
- Map form fields to custom identifiers

## Installation
 - `composer req t3brightside/formwebhooksend`
 - Include static template
 - Add finisher to your form and edit the fields
- Custom values example:
```yaml
create: new
group_id: 12
```
- Map field identifiers example:
```yaml
text-1: name
email-1: mail
textarea-1: message
```

## Sources
-  [GitHub](https://github.com/t3brightside/formwebhooksend)
-  [Packagist](https://packagist.org/packages/t3brightside/formwebhooksend)
-  [TER](https://extensions.typo3.org/extension/formwebhooksend/)

## Development & maintenance
[Brightside OÜ – TYPO3 development and hosting specialised web agency](https://t3brightside.com/)
