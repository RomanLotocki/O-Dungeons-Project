# O'Dungeons -BackEnd Project-

<!-- ABOUT THE PROJECT -->
## About The Project

Welcome to the repository dedicated to the backend of the O'Dungeons website. 

You will find here all the code related to the BackOffice, the relations with our database and the dedicated API RESTful to communicate with the front side of the project.

### Built With

* Based on [PHP 7.4.3](https://www.php.net/)
* Using framework [Symphony 5.4](https://symfony.com/)

## Getting Started

### Prerequisites

* PHP 7.4.3 installed
* Apache2 2.4.41 installed
* MariaDB installed

### Installation

1. Clone this repository

  ```sh
  git clone git@github.com:O-clock-apollo/projet-17-o-dungeons-back.git
  ```

2. Install dependencies and framework bundles

```sh
composer install
```

3. Create a file `.env.local`

```sh
nano .env.local
```

4. Copy/paste the following line and change the `db_user`/`db_password`/`db_name`/`db_version` to match your database connection

```nano
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-db_version"
```

5. Create your database:

   >#### Option 1: Your database user already exists and have all privileges
    >```sh
    >bin/console doctrine:create:database
    >```
  
   >#### Option 2: Your database user already exists and do not have all privileges
    >Create your database through MySql and add privileges to your user

   >#### Option 3: Your database user does not exist
    >Create your database through MySql then create your user and add it the privileges

6. Fill your database
   ```sh
   bin/console doctrine:migration:migrate
   bin/console doctrine:fixtures:load --env=dev
   ```

7. Enjoy :wink: