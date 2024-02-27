<h1 align="center">
  DDD & CQRS in PHP
</h1>

## 🚀 Environment Setup

### 🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git clone https://github.com/codeyani/ddd-php-sample.git`
3. Move to the project folder: `cd ddd-php-sample`

### 🛠️ Environment configuration

1. Create a local environment file (`cp .env .env.local`) if you want to modify any parameter

### 🔥 Application execution

1. Install all the dependencies and bring up the project with Docker executing: `make build`
2. Then you'll have 3 apps available (2 APIs and 1 Frontend):
   1. [Mooc Backend](apps/mooc/backend): http://localhost:8030/health-check
   2. [Backoffice Backend](apps/backoffice/backend): http://localhost:8040/health-check
   3. [Backoffice Frontend](apps/backoffice/frontend): http://localhost:8041/
   4. [Backoffice Frontend - Health check](apps/backoffice/frontend): http://localhost:8041/health-check

### ✅ Tests execution

1. Install the dependencies if you haven't done it previously: `make deps`
2. Execute PHPUnit and Behat tests: `make test`

### Aggregates

You can see an example of an aggregate [here](src/Mooc/Users/Domain/User.php). All aggregates should
extend the [AggregateRoot](src/Shared/Domain/Aggregate/AggregateRoot.php).

### Command Bus

There is 1 implementations of the [command bus](src/Shared/Domain/Bus/Command/CommandBus.php).
1. [Sync](src/Shared/Infrastructure/Bus/Command/InMemorySymfonyCommandBus.php) using the Symfony Message Bus.

### Query Bus

The [Query Bus](src/Shared/Infrastructure/Bus/Query/InMemorySymfonyQueryBus.php) uses the Symfony Message Bus.

### Event Bus

The [Event Bus](src/Shared/Infrastructure/Bus/Event/InMemory/InMemorySymfonyEventBus.php) uses the Symfony Message Bus.
The [MySql Bus](src/Shared/Infrastructure/Bus/Event/MySql/MySqlDoctrineEventBus.php) uses a MySql+Pulling as a bus.
The [RabbitMQ Bus](src/Shared/Infrastructure/Bus/Event/RabbitMq/RabbitMqEventBus.php) uses RabbitMQ C extension.

## 📱 Monitoring

Every time a domain event is published it's exported to Prometheus. You can access to the Prometheus panel [here](http://localhost:9999/).

