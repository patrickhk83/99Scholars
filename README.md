### Framework ###

- We use Kohana, a MVC framework, for development. Read more about it [here](http://kohanaframework.org)
- If you are not familiar with Git, please study it's workflow [here](http://git-scm.com)

### Setting up environment ###

Here are some configurations to make it work in your environment.

- Change application path at `base_url` in application/bootstrap.php and, if you enabled mod_rewrite in Apache, `RewriteBase` in .htaccess
- Change configuration for database in application/config/database.php
- Change timezone at `date_default_timezone_set()` in in application/bootstrap.php