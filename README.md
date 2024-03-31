## About BackEndCMS

BackEndCMS will be a Starter Template for Conetnt Management related web applications based on Laravel framework. I believe developing a Web Application from scratch is time consuming and not must be an enjoyable experience . So Lets work on Minimizng the efforts .

### Project Started on 30/11/2023 


## comands to be run on Producton ENvironment

```shell 
composer install --optimize-autoloader --no-dev 
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
```


# Laravel BackEndCMS

## Overview
Laravel BackEndCMS is a comprehensive content management system (CMS) built on the Laravel framework. It provides a robust backend solution for managing website content efficiently. With its rich feature set and Laravel's powerful capabilities, it offers an intuitive and flexible platform for content creation, organization, and administration.

## Current Features
- **User Authentication:** Secure authentication system powered by Laravel's built-in authentication features.
- **Content Management:** Create, edit, and delete various types of content such as articles, pages, and media files.
- **SEO Optimization:** Implement SEO best practices with meta tags, friendly URLs, and sitemap generation.

## Features need to be implemented later
- **Role-Based Access Control:** Define roles and permissions for users to manage access levels within the CMS.
- **Customizable Templates:** Utilize Laravel's Blade templating engine to customize templates for different content types.
- **Version Control:** Leverage Laravel's version control capabilities to track changes made to content.
- **Plugin System:** Extend functionality with Laravel packages and custom plugins for additional features or integrations.

## Motivation
Laravel BackEndCMS aims to provide a user-friendly and feature-rich CMS solution for web developers and businesses. By leveraging Laravel's expressive syntax and powerful ecosystem, it offers an efficient and scalable platform for managing website content.

## Installation
To install Laravel BackEndCMS, follow these steps:
1. Clone the repository: `git clone https://github.com/madhuryadutta/BackEndCMS.git`
2. Navigate to the project directory: `cd BackEndCMS`
3. Install Composer dependencies: `composer install`
4. Copy the `.env.example` file to `.env` and configure database settings.
5. Generate application key: `php artisan key:generate`
6. Run database migrations: `php artisan migrate`
7. Start the Laravel development server: `php artisan serve`
8. Access the CMS interface at `http://localhost:8000`

## Usage
Once installed, users can access the CMS interface through a web browser. From there, they can log in, create or edit content, manage users and roles, and configure settings according to their needs. Detailed usage instructions and tutorials can be found in the documentation.

## Contributing
Contributions to Laravel BackEndCMS are welcome! To contribute, please fork the repository, make your changes, and submit a pull request following the guidelines outlined in the CONTRIBUTING.md file.

## License
This project is licensed under the GNU General Public License v3.0 - see the [LICENSE](LICENSE) file for details.

## Credits
Laravel BackEndCMS is developed and maintained by [Madhurya Dutta](https://github.com/madhuryadutta) and contributors.

## Acknowledgements
Special thanks to all those who have contributed or will contribute to this project..

