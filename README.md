# unleashed
# Set up Instructions
- Clone this repository.
- Run composer install.
- Set up MySQL database credentials in .env file.
- Create database using command 'php bin/console doctrine:database:create'. Make sure you have Doctrine 'orm Symfony pack' and Maker bundle installed
- Run Migration commands 'php bin/console make:migration' and 'php bin/console doctrine:migrations:migrate'.
- For bootstrap Framework, use Yarn to add bootstrap using command 'yarn add bootstrap --dev'
