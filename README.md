# OCR-MiniCMS

 [Projet] Ouvrez votre propre projet OpenSource

## REQUIREMENTS

* [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)
* [StofDoctrineExtensionsBundle](https://github.com/stof/StofDoctrineExtensionsBundle)


## DOWNLOAD

```
$ git clone https://github.com/lew13010/OCR-MiniCMS.git
```

OR

Download [master.zip](https://github.com/lew13010/OCR-MiniCMS/archive/master.zip), and unzip in your folder.


## INSTALLATION

#### Enable the bundle

* Enable the bundle in your *app/AppKernel.php* :

```
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
        ...
            new Loic\CMSBundle\LoicCMSBundle(),
            new Loic\UserBundle\LoicUserBundle()
        ]
```

#### Routes

* Routes *(app/config/routing.yml) :*

```
loic_cms:
    resource: "@LoicCMSBundle/Resources/config/routing.yml"
    prefix:   /
```

#### Configuration and Parameters

* Activate Sluggable *(app/config/config.yml) :*


```
stof_doctrine_extensions:
    orm:
        default:
            sluggable: true
```

* Activate loggable *(app/config/config.yml) :*

```
doctrine:
    orm:
        auto_generate_proxy_classes: "%kernel.debug%"
        naming_strategy: doctrine.orm.naming_strategy.underscore
        auto_mapping: true
        mappings:
            gedmo_loggable:
                type: annotation
                alias: Gedmo
                prefix: Gedmo\Loggable\Entity
                dir: "%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Loggable/Entity"
```

* Configuration *(app/config/security.yml) :*
```
security:
    encoders:
        Loic\UserBundle\Entity\User: sha512

    role_hierarchy:
        ROLE_ADMIN: ROLE_USER
        ROLE_SUPER_ADMIN: ROLE_ADMIN

    providers:
        main:
            id: fos_user.user_provider.username

    firewalls:
        main:
            pattern: ^/
            anonymous: true
            provider: main
            form_login:
                login_path: fos_user_security_login
                check_path: fos_user_security_check
            logout:
                path: fos_user_security_logout
                target: loic_cms_homepage
            remember_me:
                secret: %secret%


    access_control:
        - { path: ^/admin/, role: ROLE_ADMIN }
```

* Versioning article *(app/config/config.yml) :*

You can change the parameter for activate or not.
```
loic_cms:
    versioning: true #true or false
```


* Roles access article *(app/config/config.yml) :*

You can choose the role by default :
```
loic_cms:
    role_default: IS_AUTHENTICATED_ANONYMOUSLY #IS_AUTHENTICATED_ANONYMOUSLY or ROLE_ADMIN or ROLE_USER
```

### Database

```
$ php bin/console doctrine:database:create
```

```
$ php bin/console doctrine:schema:update --force
```

## Create first "ADMIN"

```
$ php bin/console fos:user:create testuser test@example.com p@ssword
```

```
$ php bin/console fos:user:promote testuser ROLE_ADMIN
```

## USE

* IMPORTANT

Create at least one category before the first article.