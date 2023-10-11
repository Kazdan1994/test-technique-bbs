# Instagram Post Display - Laravel Project

A Laravel project for displaying Instagram posts on a web page. This README.md provides instructions on how to set up the project, configure Instagram API permissions, and more.

## Table of Contents

- [Project Overview](#project-overview)
- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
- [Configuring Instagram API](#configuring-instagram-api)
- [Usage](#usage)

## Project Overview

This project allows you to display Instagram posts on a web page using Laravel. You will need to configure Instagram API permissions to access user posts.

## Getting Started

Follow these steps to set up and run the project.

### Prerequisites

- Laravel (Install Laravel if not already done)
- Instagram Developer Account

### Installation

1. Clone this repository to your local machine.

2. Install project dependencies using Composer:
   ```bash
   composer install
   ```

3. Configure the Laravel .env file with your database and Instagram API credentials.

4. Migrate the database:
    ```bash
    php artisan migrate
    ```

5. Start the Laravel development server:
    ```bash
    php artisan serve
    ```

6. You'll need a tunnel for your app
    ```bash
    ngrok http 80 
    ```

## Configuring Instagram API

To display Instagram posts, you need to create an Instagram App and obtain the necessary permissions:

1. Create a Facebook App:

    Go to the Facebook Developers website and create a new app. This app will be used to access the Instagram Basic Display API.
    Configure your app by providing the necessary details.


2. Add Instagram to Your App:

    In your Facebook app settings, navigate to the "Add a Product" section.
    Add the Instagram product and configure it by providing the necessary details, including a Privacy Policy URL.


3. Get Instagram Basic Display Access:

    Go to the Instagram Basic Display settings within your app.
    Configure the basic display settings by providing a redirect URI, data deletion callback URL, and permissions.**


4. Obtain Instagram Basic Display Access:

* Get App ID and App Secret
* Create an Instagram Test User


5. Add Instagram credentials to your Laravel .env file:

```dotenv
INSTAGRAM_APP_ID=your_app_id
INSTAGRAM_APP_SECRET=your_app_secret
INSTAGRAM_REDIRECT_URI=your_redirect_uri # should end with /oauth/callback/instagram
```

## Usage

1. Access the Instagram post display page using your web browser.

2. Users should be able to connect to their Instagram account and view their latest posts.
