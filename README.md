# TheWallet

![GitHub repo size](https://img.shields.io/github/repo-size/wmlavrador/the-wallet?style=for-the-badge)
![GitHub language count](https://img.shields.io/github/languages/count/wmlavrador/the-wallet?style=for-the-badge)
![GitHub forks](https://img.shields.io/github/forks/wmlavrador/the-wallet?style=for-the-badge)
![Bitbucket open issues](https://img.shields.io/bitbucket/issues/wmlavrador/the-wallet?style=for-the-badge)
![Bitbucket open pull requests](https://img.shields.io/bitbucket/pr-raw/wmlavrador/the-wallet?style=for-the-badge)

> The idea is to provide a simple transfer of funds between user wallets. Users can transfer funds between Wallets, for example, from Wallet Customer Type to Wallet Company Type, based on certain rules and checks with external services.

## 💻 Prerequisites

Before you begin, make sure you meet the following requirements:

- You have installed the latest version of `<git & docker & docker-compose>`

## 🚀 Installing TheWallet

To install the-wallet, follow these steps:

Linux/macOS/Windows:

### 1. Clone the Repository
Clone this repository to your local environment:
```
git clone git@github.com:wmlavrador/the-wallet.git
```

### 2. Environment Setting
Navigate to the cloned project directory
```
cd the-wallet
```

### 3. Create the .env file
Rename the example file .env.example to .env
```
cp .env.example .env
```
Rename laravel .env.example file inside on path /application to .env
```
cp application/.env.example application/.env
```

### 4. Initialize Docker Containers
Run the docker-compose up command to start the containers:
```
docker-compose up
```

### 5. Installing Laravel Dependencies
Access the app the-wallet container
```
docker-compose exec app_the_wallet bash
```
Inside the container install the dependencies using Composer:
```
composer install
```
Still inside the container, generate the Laravel encryption key:
```
php artisan key:generate
```
Execute the permissions of the folders used by laravel
```
chown www-data:www-data -R /var/www/storage/logs
chown www-data:www-data -R /var/www/storage/framework
```
Run the migrations, if you prefer you can also feed the database with the seeders with the command
```
php artisan migrate --seed
```
🚀 Congrats bro

## ☕ Usando the-wallet

When running your application, you will be able to view the Swagger documentation at the address

```
http://localhost/api/documentation
```

## 😄 Be one of the contributors

Do you want to be part of this project? Click [Here](CONTRIBUTING.md) and read how to contribute.

## 📝 License

This project is under license. See the file [License](LICENSE.md) for more details.