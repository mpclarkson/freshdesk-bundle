# FreshdeskBundle

[![Build Status](https://travis-ci.org/mpclarkson/freshdesk-bundle.svg?branch=master)](https://travis-ci.org/mpclarkson/freshdesk-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mpclarkson/freshdesk-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mpclarkson/freshdesk-bundle/?branch=master)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9bc7be97-3ed1-4895-944e-05658edd7a4f.svg)](https://insight.sensiolabs.com/projects/9bc7be97-3ed1-4895-944e-05658edd7a4f)
[![Packagist](https://img.shields.io/packagist/v/mpclarkson/freshdesk-bundle.svg)](https://packagist.org/packages/mpclarkson/freshdesk-bundle)

This is a Symfony2-3 bundle to interact with the Freshdesk API v2 via 
the [freshdesk-php-sdk](https://github.com/mpclarkson/freshdesk-php-sdk).

## Requirements

- Symfony 2.8+
- PHP 5.5+
- A Freshdesk account

## Installation

To add this bundle to your Symfony app, use [Composer](https://getcomposer.org).

Add `mpclarkson/freshdesk-bundle` to your **composer.json** file:

```json
{
    "require": {
        "mpclarkson/freshdesk-bundle": "dev-master"
    }
}
```

Add the bundle to `AppKernel.php`:

```php
public function registerBundles()
{
    $bundles = array(
        // ...
            new Mpclarkson\FreshdeskBundle\FreshdeskBundle(),
        // ...
    );
}
```

Configure the bundle in `config.yml`:

```yaml
freshdesk:
    api_key: your_freshdesk__api_key
    domain: your_freshdesk_domain
```

Then run `composer update`.

## Accessing the Freshdesk API

In a controller you can access the Freshdesk client and the API resources
as follows: 

```php
$api = $this->get('freshdesk');

//Contacts
$contacts = $api->contacts->update($contactId, $data);

//Agents
$me = $api->agents->current();

//Companies
$company = $api->companies->create($data);

//Groups
$deleted = $api->groups->delete($groupId);

//Tickets
$ticket = $api->tickets->view($filters);

//Time Entries
$time = $api->timeEntries->all($ticket['id']);

//Conversations
$ticket = $api->conversations->note($ticketId, $data);

//Categories
$newCategory = $api->categories->create($data);

//Forums
$forum = $api->forums->create($categoryId, $data);

//Topics
$topics = $api->topics->monitor($topicId, $userId);

//Comments
$comment = $api->comments->create($forumId);

//Email Configs
$configs = $api->emailConfigs->all();

//Products
$product = $api->products->view($productId);

//Business Hours
$hours = $api->businessHours->all();

//SLA Policy
$policies = $api->slaPolicies-all();
```

### Filtering

All `GET` requests accept an optional `array $query` parameter to filter
results. For example:

```php
//Page 2 with 50 results per page
$page2 = $this->forums->all(['page' => 2, 'per_page' => 50]);

//Tickets for a specific customer
$tickets = $this->tickets->view(['company_id' => $companyId]);
```

Please read the Freshdesk documentation for further information on
filtering `GET` requests.

## Contributing

This is a work in progress and PRs are welcome. Please read the 
[contributing guide](.github/CONTRIBUTING.md).

## Author

The library was written and maintained by [Matthew Clarkson](http://mpclarkson.github.io/) 
from [Hilenium](https://hilenium.com).

## References

* [Freshdesk PHP SDK](https://github.com/mpclarkson/freshdesk-php-sdk)
* [Freshdesk API Documentation](https://developer.freshdesk.com/api/)
