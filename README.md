# System testing (browser based) package for Joomla

### Abstract

This repo is meant to hold the decoupled com_weblinks component and related code.


### Installation

#### For Linux

##### 1. Open a session and change to the document root of your local webserver.

```
$ cd /var/www/html/
/var/www/html$
```

##### 2. Clone the current joomla repository into your webserver root folder

```
/var/www/html$ git clone git@github.com:joomla/joomla-cms.git
Clone nach 'joomla-cms' ...
remote: Counting objects: 640229, done.
remote: Compressing objects: 100% (138/138), done.
remote: Total 2446 (delta 10), reused 0 (delta 0), pack-reused 2361
Empfange Objekte: 100% (2446/2446), 615.02 KiB | 375.00 KiB/s, Fertig.
Löse Unterschiede auf: 100% (1232/1232), Fertig.
Prüfe Konnektivität ... Fertig.
```

Are you new with github? Here you can find informations about setting it up: https://help.github.com/articles/set-up-git/
If you get an error you can try <tt>git clone https://github.com/joomla/joomla-cms.git</tt> instead of <tt>git clone git@github.com:joomla/joomla-cms.git</tt>

##### 3. Change to the directory joomla-cms and make sure that you are on the 4.0-dev branch

Change to the directory:
```
/var/www/html$ cd joomla-cms
/var/www/html/joomla-cms$
```
Make sure you are on the correct branch:
```
/var/www/html/joomla-cms$ git branch
* staging
/var/www/html/joomla-cms$ git fetch origin 4.0-dev:4.0-dev
Von https://github.com/joomla/joomla-cms
 * [neuer Branch]    4.0-dev    -> 4.0-dev
/var/www/html/joomla-cms$ git checkout 4.0-dev
Zu Branch '4.0-dev' gewechselt
/var/www/html/joomla-cms$ git branch
* 4.0-dev
  staging

```

##### 4. Your joomla-cms folder should contain this files:

```
/var/www/html/joomla-cms$ ls
acceptance.suite.yml  cli                 Gemfile       jenkins-phpunit.xml  modules            RoboFile.php          web.config.txt
administrator         codeception.yml     htaccess.txt  karma.conf.js        package.json       robots.txt.dist
appveyor-phpunit.xml  components          images        language             phpunit.xml.dist   scss-lint.yml
build                 composer.json       includes      layouts              plugins            templates
build.js              composer.lock       index.php     libraries            README.md          tests
build.xml             dev                 installation  LICENSE.txt          README.txt         tmp
cache                 drone-package.json  Jenkinsfile   media                RoboFile.dist.ini  travisci-phpunit.xml

```

##### 5. Optional: Have a look into composer.json for information what software you will install via composer.

```
/var/www/html/joomla-cms$ cat composer.json
```


Read more about [how to install composer](https://getcomposer.org/doc/00-intro.md) here.

#### 6. Install via composer

```
/var/www/html/joomla-cms$ composer install
Loading composer repositories with package information
Installing dependencies (including require-dev) from lock file
Package operations: 63 installs, 0 updates, 0 removals
  - Installing behat/gherkin (v4.4.5): Downloading (100%)
  - Installing sebastian/recursion-context (3.0.0): Downloading (100%)
...
 - Installing joomla/test-system (dev-master ca3879f): Cloning ca3879f603
...
Generating optimized autoload files

```

Now you see this repo in the folder <tt>/var/www/html/joomla-cms/libraries/vendor/joomla/test-system</tt>

##### 7. Optional: Prepare the database
If you use MySQL or PostgreSQL as database and your user has create database privileges the Database is automatically created by the Joomla installer.
But the safest way is to create the database before running Joomla's web installer.

```
/var/www/html/joomla-cms$ mysql -u root -p

mysql> create database test_joomla;
Query OK, 1 row affected (0,00 sec)

mysql> quit;
Bye
```

##### 8. Update the file acceptance.suite.yml to your needs.
Important are the options
 - <tt>url</tt> in the section <tt>JoomlaBrowser</tt> and <tt>Helper\Acceptance</tt>,
 - <tt>database name</tt> and
 - <tt>database user</tt>.
 - <tt>database password</tt>.

```
/var/www/html/joomla-cms$ cat acceptance.suite.yml

class_name: AcceptanceTester
modules:
    enabled:
        - Asserts
        - JoomlaBrowser
        - Helper\Acceptance
    config:
        JoomlaBrowser:
            url: 'http://localhost/joomla-cms/test-install'     # the url that points to the joomla installation at /tests/system/joomla-cms
            browser: chrome
            window_size: 1280x1024
            username: 'admin'                      # UserName for the Administrator
            password: 'admin'                      # Password for the Administrator
            database host: 'localhost'             # place where the Application is Hosted #server Address
            database user: 'root'                  # MySQL Server user ID, usually root
            database password: 'YOURDBPASSWORD'    # MySQL Server password, usually empty or root
            database name: 'test_joomla'           # DB Name, at the Server
            database type: 'mysqli'                # type in lowercase one of the options: MySQL\MySQLi\PDO
            database prefix: 'jos_'                # DB Prefix for tables
            install sample data: 'no'              # Do you want to Download the Sample Data Along with Joomla Installation, then keep it Yes
            sample data: 'Default English (GB) Sample Data'    # Default Sample Data
            admin email: 'admin@mydomain.com'      # email Id of the Admin
            language: 'English (United Kingdom)'   # Language in which you want the Application to be Installed
        Helper\Acceptance:
            url: 'http://localhost/joomla-cms/test-install' # the url that points to the joomla installation at /tests/system/joomla-cms - we need it twice here
            MicrosoftEdgeInsiders: false             # set this to true, if you are on Windows Insiders

error_level: "E_ALL & ~E_STRICT & ~E_DEPRECATED"
```

##### 9. Copy the file <tt>acceptance.suite.yml</tt> to this repo.

Currently we need the configuation file twice!

```
/var/www/html/joomla-cms$ cp acceptance.suite.yml ./libraries/vendor/joomla/test-system/src
astrid@acer:/var/www/html/joomla-cms$
```

##### 10. Optional: Create and edit the file RoboFile.ini.

```
/var/www/html/joomla-cms$ cat RoboFile.ini
; If you want to setup your test website (document root) in a different folder, you can do that here.
; You can also set an absolute path, i.e. /path/to/my/cms/folder
cmsPath = test-install

; (Linux / Mac only) If you want to set a different owner for the CMS root folder, you can set it here.
localUser =
```


##### 11. Optional: Set use owner of the project to your user.

Change the username/usergroup of the files by traveling the directories recursively.
This is made possible by the ‘-R’ option.

```
/var/www/html/joomla-cms$sudo chown -R username:usergroup /var/www/html/joomla-cms
```


### Running - Ready! Run the first tests


#### For Linux

```
/var/www/html/joomla-cms$ libraries/vendor/bin/robo run:tests➜  Running tests
 [Filesystem\DeleteDir] Deleted test-install...
 [Filesystem\CopyDir] Copied from ./media to test-install/media
 [Filesystem\CopyDir] Copied from ./nbproject to test-install/nbproject
 [Filesystem\CopyDir] Copied from ./images to test-install/images
 [Filesystem\CopyDir] Copied from ./libraries to test-install/libraries
...
```
Now a browser window opens and you can see the tests running in it.

If you get an error like this

```
/var/www/html/joomla-cms$ libraries/vendor/bin/robo run:tests
➜  Running tests
 [Filesystem\CopyDir] Copied from ./media to test-install/media
 [Filesystem\CopyDir] Copied from ./nbproject to test-install/nbproject
 [Filesystem\CopyDir] Copied from ./images to test-install/images
 [error]  Failed to copy "./libraries/vendor/consolidation/robo/scenarios/symfony2/tests" because file does not exist.
```
you have to delete two files:
```
/var/www/html/joomla-cms$ rm ./libraries/vendor/consolidation/robo/scenarios/symfony2/tests
/var/www/html/joomla-cms$ rm ./libraries/vendor/consolidation/robo/scenarios/symfony4/tests
```

The tests use Codeception Testing Framework, if you want to know more about the technology used for testing please check: [Testing Joomla Extensions with Codeception](https://docs.joomla.org/Testing_Joomla_Extensions_with_Codeception).
