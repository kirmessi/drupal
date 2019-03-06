# Drupal solutions

- drupal site:mode dev
- drush cr //clear all cache
- drush pm:uninstall <module>

**Show Errors**
- add strings to settings.php:
  - error_reporting(E_ALL);
  - ini_set('display_errors', TRUE);
  - ini_set('display_startup_errors', TRUE);

**Export / Import Settings**
- drush config-export --destination <folder>
- drush config-import --source <folder>

**Export / Import database**
- drush sql-dump > ~/my-sql-dump-file-name.sql //export
- drush sql-cli < ~/my-sql-dump-file-name.sql //import


**Drush**
- cd /usr/local
- sudo git clone https://github.com/drush-ops/drush
- cd drush
- sudo composer update
- php drush --version
- sudo rm -f /usr/local/bin/drush
- sudo ln -s /usr/local/drush/drush /usr/local/bin/drush
- drush --version
- https://github.com/drush-ops/drush

**Devel**
- composer require drupal/devel, then go to Extend and install:
- Devel
- Devel generate
- Devel kint
- Web Profiler

**Webform**
- composer require drupal/webform

**Custom theme**
- **create** skeleton folders and files, required for custom theme
- sites/all/themes/mytheme/mytheme.info.yml (name, description, regions)
- sites/all/themes/mytheme/mytheme.libraries.yml (connect css, js)
  - sites/all/themes/mytheme/assets/css
  - sites/all/themes/mytheme/assets/js
- sites/all/themes/mytheme/mytheme.theme (Implements hooks)
- sites/all/themes/mytheme/config/install/mytheme.settings.yml (schemas: [])
- sites/all/themes/mytheme/config/schema/mytheme.schema.yml (two settings)
**templates**
(copy from core/modules/system/templates)
- sites/all/themes/mytheme/templates/html.html.twig
- and any templates, what you need
**Then install your's theme and set is as default**

**Basic settings for great work**
- in /sites/default/settings.php uncomment the lines at the bottom of 'sites/example.com/settings.php'
- in /sites/default/settings.local.php uncomment next strings:
  - $settings['cache']['bins']['render'] = 'cache.backend.null';
  - $settings['cache']['bins']['page'] = 'cache.backend.null';
  - $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
- in /sites/default/services.yml set in section twig.config:
  - debug: true
  - auto_reload: true
  - cache: null
- in render.config section:
  - http.response.debug_cacheability_headers: true
  
**REST API**

  Then implementing get method in Drupal\firstmodule\Plugin\rest\resource;

 http://site.ru/api/custom/test?_format=json&hello-world=nix

  for control from admin panel, install REST UI from https://www.drupal.org/project/restui


