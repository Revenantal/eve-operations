<p align="center">
<a href="https://travis-ci.org/revenantal/eve-operations"><img src="https://travis-ci.org/revenantal/eve-operations.svg" alt="Build Status"></a>
</p>
## Installation

### Step 1

> To run this project, you must have PHP 7.2 installed as a prerequisite.

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

```
git clone https://github.com/revenantal/eve-operations.git
cd eve-operations && composer install && npm install
php artisan eveops:install
npm run dev
```

### Step 2

Next, run  the following command and follow the steps
```
php artisan eveops:init
```

### Step 3

Customize your permissions, roles and whitelist.
Enjoy your new tool.