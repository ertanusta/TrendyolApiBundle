Trendyol API PHP Symfony Bundle
=======================

This package has been prepared for the use of trendyol API services.


Installation
------------

### Step 1: Download TrendyolAPIBundle using composer

Require the `ertanusta/trendyol-api-bundle` with composer [Composer](http://getcomposer.org/).

```bash
$ composer require ertanusta/trendyol-api-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Trendyol\ApiBundle\TrendyolApiBundle::class => ['all' => true],
];
```

### Step 3: Configure the AcmePhpBundle

Below is a minimal example of the configuration necessary to use the
`TrendyolApiBudnle` in your application:

```yml
# config/packages/trendyol_api.yml

trendyol_api:
  supplier_id: "supplier_id"
  app_key: "app_key"
  app_secret: "app_secret"
  integrator: "self"
```
> At the same time, you can change the parameters according to the environment situation by keeping them under config/packages/dev/ or config/packages/prod directories.

Usage
-----

After installing the package and entering the necessary configurations. You can access Trendyol API services with the services included in the package.

```php
    /**
     * @Route("/", name="index")
     */
    public function method(CargoService $service)
    {
        $result = $service->getSuppliersAddresses();
    }
```
To dynamically change your Trendyol configuration:

```php
    /**
     * @Route("/", name="index")
     */
    public function index(CargoService $service)
    {
        $service->setIntegrator("12345");
        $service->setAppSecret("app_key");
        $service->setAppKey("app_secret");
        $service->setSellerId("12345");
        $result = $service->getSuppliersAddresses();
    }
```


Extensions
----------

**Trendyol API Url Edit**: Trendyol API Url addresses are available under Resources/config/packages/dev/trendyol_url. To make changes in api url addresses, you can copy the content of the file and update it according to you.

```yml
# config/trendyol_api_url.yaml

trendyol_url:
  shipment_providers: "https://api.trendyol.com/sapigw/shipment-providers"
  .
  . 
  .
  .
```

It is enough to write the path information of the yaml file containing the api addresses you created.
```yml
# config/packages/trendyol_api.yaml

trendyol_api:
  supplier_id: "supplier_id"
  app_key: "app_key"
  app_secret: "app_secret"
  integrator: "123456"
  url_file_path: "%kernel.project_dir%/config/trendyol_api_url.yaml"
```
> Some parameters in the URL structure are expected to be exactly the same. Otherwise the service classes will not work properly.

**Trendyol Client:** By creating another Client class implemented with **Trendyol\ApiBundle\Client\ClientInterface**, services can be made to use the object of this class.

```yml
# services.yaml

Trendyol\ApiBundle\Client\ClientInterface: '@App\Client\AnotherTrendyolClient'

```

**Trendyol Url Factory:** The UrlFactory class created using **Trendyol\ApiBundle\Factories\UrlFactoryInterface** can be used.
```yml
# services.yaml

Trendyol\ApiBundle\Factories\UrlFactoryInterface: '@App\Factories\AnotherTrendyolUrlFactory'

```