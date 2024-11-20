# real-estate-property-management-system
A simple CRUD application for managing property listings through RESTFul API, focusing on using Symfony Event Dispatching to handle specific events during the property management lifecycle, and validating form using symfony form validation.

---
# Steps to start project

## Table of Contents
1. [Clone the Repository](#1-clone-the-repository)
2. [Install Dependencies](#2-install-dependencies)
3. [Set Up Environment Files](#3-set-up-environment-files)
4. [Set Up the Database](#4-set-up-the-database)
    - [Create the Database](#create-the-database)
    - [Run Migrations](#run-migrations)
    - [Optional: Different Database for Specific Environments](#optional-different-database-for-specific-environments)
5. [Start the Symfony Server](#5-start-the-symfony-server)
6. [API Reference](#6-api-reference)

---

## 1. Clone the Repository
Clone the project repository to your local environment:

```bash
git clone https://github.com/abodoma17/real-estate-property-management-system.git
```

```bash 
cd real-estate-property-management-system
```
--- 

## 2. Install Dependencies
Ensure you have Composer installed, then run:

```bash
composer install
```
--- 
## 3. Set Up Environment Files
   Copy the example .env file to configure your environment variables:

```bash
cp .env.example .env
```
If needed, also create a .env.test file for test configurations:

```bash
cp .env.test.example .env.test
```
Edit the .env and .env.test files to match your database and other environment-specific settings.

---
## 4. Set Up the Database

### Create the Database
Run the following command to create the database defined in your .env file:

```bash
php bin/console doctrine:database:create
```

### Run Migrations
Apply the migrations to set up the database schema:

```bash
php bin/console doctrine:migrations:migrate
```

Optional: Different Database for Specific Environments\
If you’re setting up a separate database for development or testing, use the --env option:

```bash
php bin/console doctrine:database:create --env=test
php bin/console doctrine:migrations:migrate --env=test
```

---
## 5. Start the Symfony Server
   Run the following command to start the local Symfony server:

```bash
symfony serve
```
The server will run at http://127.0.0.1:8000 by default.

---

## 6. API Reference
   Refer to the [Postman Collection](https://www.postman.com/omarabodoma/d455e068-1440-4814-817c-61a3dd01174e/collection/hudkdc8/real-estate-property-management-system)
   for API details