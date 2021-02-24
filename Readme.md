# Project Deployment #

After running the `composer install` command revert the following files:

```bash
# .htaccess -checkout due to websites mapping and custom rewrite rules
git checkout .htaccess
```
# Deploying changes to the server #

Deployment is automated to decrease the possible downtime. Files to run:
- `deploy-theme-only.sh` - deploy changes to templates, layouts, CSS, DI etc., without installing new modules, upgrading them or changing modules sequence.
- `deploy-full.sh` - deploy changes that include installing new modules, or data/schema upgrades.

To use this scripts the following environment variables must be set:
- `BUILD_SYSTEM_PATH` - path to the build system without `/` at the end (not visible from the web);
- `LIVE_SYSTEM_PATH` - path to the live system `/` at the end (development, staging, production etc.);
- `GIT_BRANCH` - branch to checkout and deploy.

To add these variables to the environment, run the following commands and restart the terminal session. Ensure that
`.bash_aliases` is available in your OS (debian-based mostly), use `~/.bash_profile` or other respective file otherwise:

```bash
export BUILD_SYSTEM_PATH="/path/to/the/build/system/" >> ~/.bash_aliases
export PRODUCTION_SYSTEM_PATH="/path/to/the/production/system/" >> ~/.bash_aliases
export GIT_BRANCH="name-of-you-branch" >> ~/.bash_aliases
```

Deployment process flow implemented in the above files:

1) go to the build system located in `/path/to/the/build/system/`;
2) pull changes, install modules, compile code and assets;
3) go to the live system in `/path/to/the/production/system/`;
4) enter maintenance mode (only for `deploy-full.sh`);
5) pull changes, run `composer install` (only for `deploy-full.sh`) and `setup:upgrade`;
6) copy generated files from the build system;
7) switch to the production mode;
8) turn off maintenance (only for `deploy-full.sh`).

#Magento upgrade process - preparation
Turn off the current project to upgrade infrastructure and to save RAM:
$ cd ${PROJECTS_ROOT_DIR}firstname-lastname-dev.local/
$ docker-compose -f docker-compose-dev.yml down
$ cd ${PROJECTS_ROOT_DIR}firstname-lastname-build.local/
$ docker-compose -f docker-compose-build.yml down
$ cd ${PROJECTS_ROOT_DIR}firstname-lastname.local/
$ docker-compose down

Install fresh Magento 2.4.1 and turn it off:
$ SETUP 2.4.1 --domains="magento-241.local www.magento-241.local" -n
$ cd ${PROJECTS_ROOT_DIR}magento-241.local/
$ docker-compose down


#Magento upgrade process - database upgrade
Create an uncompressed database dump:
$ cd ~/misc/db/
$ docker exec -it mysql57 sh -c "mysqldump -u<user> -p <db_name> --no-tablespaces > /tmp/db.sql"
$ docker container cp mysql57:/tmp/db.sql db.sql
$ docker exec -it mysql57 rm /tmp/db.sql

Create a database and used for each system, grant permissions:
$ mysql -uroot -proot -h127.0.0.1 --port=3380 --show-warnings
$ CREATE DATABASE <database>;
$ CREATE USER '<user>'@'%' IDENTIFIED BY '<password>';
$ GRANT ALL ON <database>.* TO '<user>'@'%';

Import the dump:
$ USE <database>
$ SOURCE ~/misc/db/<dump.sql>
$ exit

$ docker-compose <-f docker-compose-*.yml>  up -d --force-recreate
Drop databases from `mysql57`:

#Magento upgrade process - running upgrade
Remove the lock file and installed packages:
$ rm composer.lock && rm -rf vendor/*

Run upgrade:
$ docker exec -it firstname-lastname.local-dev composer install
$ git checkout .htaccess .gitignore
$ docker exec -it firstname-lastname.local-dev php bin/magento setup:upgrade
$ docker exec -it firstname-lastname.local-dev php bin/magento deploy:mode:set production

#Magento 2 themes
Magento is shipped with the several themes out of the box:
base - module-level files that are common for all themes;
Magento 2 backend - theme for Admin Panel.
Location: `vendor/magento/theme-adminhtml-backend/`
Magento Blank - storefront theme with minimalistic styles.
Location: `vendor/magento/theme-frontend-blank/`
Magento Luma - fully-featured storefront theme based on Blank.
Location: `vendor/magento/theme-frontend-luma`

#Creating a Magento 2 theme 
add a new theme in Magento 2 you need to:
create a vendor folder in `app/design/frontend/`. Use your name as a vendor name (like `DVCapmus`). Use [A-Za-z0-9] for the Vendor name, use [a-z0-9];
create theme registration file `registration.php` (see the Luma theme);
create theme definition file `theme.xml` (see the Luma theme);
run `setup:upgrade`;
select your theme in Admin Panel > Content > Design section > Configuration;
clean caches.

#Compile LESS using Grunt
Less compilation via Grunt is extremely important during development. It can be set up in a few simple steps:
$ cp package.json.sample package.json
$ cp Gruntfile.js.sample Gruntfile.js
$ cp grunt-config.json.sample grunt-config.json
$ # Create theme configuration in `dev/tools/grunt/configs/local-themes.js`
$ docker exec -it firstname-lastname.local-dev bash
$ npm install
$ # Modify the `dev/tools/grunt/configs/less.js` to get source maps working with Docker
$ # by adding `outputSourceFiles: true` to the `lessOptions.options` object
$ grunt clean:theme && grunt exec:theme && grunt less:theme && grunt watch




