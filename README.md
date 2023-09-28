# Bank131 SDK

Библиотека для работы с API Bank131 в приложениях написанных на языке PHP.

## Требования

* PHP 7.3 или выше

## Установка
Рекомендуемый способ установки Bank 131 SDK - установка с помощью пакетного менеджера Composer.

Для включения данной библиотеки в ваш проект необходимо выполнить следующие команды в консоли:

```bash
cd /path/to/your/project
composer require 131/php-sdk
``` 

## Документация
Более подробные примеры в документации [API Банк 131](https://developer.131.ru)

## Быстрый старт

### Инициализация клиента: 

```php
use Bank131\SDK\Client;
use Bank131\SDK\Config;

$config = new Config(
    'https://demo.bank131.ru',
    'test_project',
    file_get_contents('/path/to/your/private_key.pem'),
    file_get_contents('/path/to/bank131/public_key.pem')
);
$client = new Client($config);
``` 

### Выпуск публичного токена для создания виджета:
```php
use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;

$request = RequestBuilderFactory::create()
    ->issuePublicTokenBuilder()
    ->setTokenizeWidget()                   // публичный токен с доступом к виджету токенизации
    ->setSelfEmployedWidget('111111111111') // публичный токен с доступом к виджету для работы с самозанятыми
    ->setAcquiringWidget('session_id')      // публичный токен с доступом к виджету эквайринга
    ->build();

$response = $this->client->widget()->issuePublicToken($request);
```

### Создание и старт эквайринг сессии:

```php
use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\Client;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Card\BankCard;

$request = RequestBuilderFactory::create()
    ->createPaymentSession()
    ->build();

/** @var Client $client */
$createSessionResponse = $client->session()->create($request);

$request = RequestBuilderFactory::create()
    ->startPaymentSession($createSessionResponse->getSession()->getId())
    ->setCard(new BankCard('4242424242424242', '12', '22', '123', 'CARDHOLDER NAME'))
    ->setAmount(10000, 'rub')
    ->setCustomer(new Customer('reference'))
    ->setMetadata('your metadata here')
    ->build();

$sessionStartResponse = $this->client->session()->startPayment($request);

``` 

### Создание и старт сессии для осуществления выплаты:

```php
use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\DTO\Card\EncryptedCard;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\Client;

$request = RequestBuilderFactory::create()
    ->createPayoutSession()
    ->build();

/** @var Client $client */
$createSessionResponse = $client->session()->create($request);

$recipient = new Participant();
$recipient->setFullName('John Doe');

$request = RequestBuilderFactory::create()
    ->startPayoutSession($createSessionResponse->getSession()->getId())
    ->setCard(new EncryptedCard('number_hash_here'))
    ->setRecipient($recipient)
    ->setAmount(10000, 'rub')
    ->setCustomer(new Customer('reference'))
    ->setMetadata('your metadata here')
    ->build();

$sessionStartResponse = $this->client->session()->startPayout($request);
``` 
### Создание объекта выплатной сессии СБП

```php
$request = RequestBuilderFactory::create()
    ->createPayoutSession()
    ->setBankAccount(
    new BankAccountFPS(
        '0070009210197',
        '100000000197',
        'Перевод средств по договору'
        )
    )
    ->build();
```

### Создание объекта платежной сессии через СБП

```php
RequestBuilderFactory::create()
    ->createPaymentSession()
    ->makeFasterPaymentSystem()
    ->setAmount('3000', \Bank131\SDK\DTO\Enum\CurrencyEnum::RUB)
    ->build();
```


### Запрос статуса сессии:
```php
use Bank131\SDK\Client;

/** @var Client $client */
$response = $this->client->session()->status('session_id');
```

### Возврат:
```php
use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;

$request = RequestBuilderFactory::create()
    ->refundSession('session_id')
    ->setAmount(1000, 'rub')
    ->setMetadata('your metadata here')
    ->build();

$response = $this->client->session()->refund($request);
```

### Запрос баланса кошелька:

```php
use Bank131\SDK\Client;

/** @var Client $client */
$response = $client->wallet()->balance();
```

### Обработка веб-хуков:
```php
use Bank131\SDK\Client;
use Bank131\SDK\Services\WebHook\Hook\WebHookTypeEnum;

/** @var Client $client */
$hook = $client->handleWebHook('sign from headers', 'request body');

switch ($hook->getType()) {
    case WebHookTypeEnum::READY_TO_CONFIRM:
        $client->session()->confirm($hook->getSession()->getId());
        break;
    case WebHookTypeEnum::READY_TO_CAPTURE:
        $client->session()->capture($hook->getSession()->getId());
        break;
    case WebHookTypeEnum::ACTION_REQUIRED:
        //do some logic
        break;
    case WebHookTypeEnum::PAYMENT_FINISHED:
        //do some logic
        break;
    case WebHookTypeEnum::PAYMENT_REFUNDED:
        //do some logic
        break;
}
``` 




