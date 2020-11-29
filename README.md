The following steps required in order to run this app:

```
composer install
```

Once its done, you need to copy UnitsConfiguration.yml.dist to UnitsConfiguration.yml

```
cp -p UnitsConfiguration.yml.dist UnitsConfiguration.yml
```

This file is kind of storage where units characteristics resides. There are few predefined, as an example. You may change existing or add new ones.

The battle may be run by issuing the following command from the CLI:

```
php index.php
```