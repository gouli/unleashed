# unleashed
# Set up Instructions
- Clone this repository.
- Run composer install.
- Set up MySQL database credentials in .env file.
- Create database using command 'php bin/console doctrine:database:create'.
- Run Migration commands 'php bin/console make:migration'.
- For bootstrap Framework, use Yarn to add bootstrap using command 'yarn add bootstrap --dev' and run 'yarn encore dev'.

# Usage Instructions
- Home page has form, which accepts Full URL, on submission it would create short url string and redirect user to Short URL info page.
- Short URL Info page, has following 3 actions :
  -- Edit the Short url or Full URL.
  -- Delete the Short URL submission.
  -- Redirect to the Full URL page.
- Short URL lists, this page contains all the submitted urls. Following actions can be performed here:
  -- View to Short URL info page.
  -- Edit the Short url or Full URL.
  -- Delete the Short URL submission.
  -- Redirect to the Full URL page.
