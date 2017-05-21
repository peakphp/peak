Migration
=========

First, create an empty database and update your application settings (default: app/config.php)

1. Create a migration script:

$ php vendor/bin/phinx create [MigrationName] -c phinx-config.php
(Windows) $ call "vendor/bin/phinx.bat" create [MigrationName] -c phinx-config.php

examples: 
    $ php vendor/bin/phinx create SystemUsersRoles -c phinx-config.php
    $ php vendor/bin/phinx create OrgInvoices -c phinx-config.php

2. See example.php to know how to use phinx with laravel schema builder

3. Run the migration: 

$ php vendor/bin/phinx migrate -c phinx-config.php -e [dev|prod]
(Windows) $ call "vendor/bin/phinx.bat" migrate -c "phinx-config.php" -e [dev|prod]


More infos on phinx: 
http://docs.phinx.org/en/latest/