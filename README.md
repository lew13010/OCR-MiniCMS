# OCR-MiniCMS

 [Projet] Ouvrez votre propre projet OpenSource

## REQUIREMENTS

* [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)
* [StofDoctrineExtensionsBundle](https://github.com/stof/StofDoctrineExtensionsBundle)


## INSTALLATION

```

```

### Enable the bundle

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

### Routes

* Routes *(app/config/routing.yml) :*

```
loic_cms:
    resource: "@LoicCMSBundle/Resources/config/routing.yml"
    prefix:   /
```

### Configuration and Parameters

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

* Versioning article *(app/config/config.yml) :*

You can change the parameter for activate or not.
```
twig:
    globals:
        versioning: true #true or false
```


* Roles access article *(app/config/parameters.yml) :*

You can choice the role by default :
```
parameters:
    role_default: IS_AUTHENTICATED_ANONYMOUSLY #IS_AUTHENTICATED_ANONYMOUSLY or ROLE_ADMIN or ROLE_USER
```

### Database

```
$ doctrine:database:create
```

```
$ doctrine:schema:update --force
```

### Create first "ADMIN"

```
$ fos:user:create testuser test@example.com p@ssword
```

```
$ fos:user:activate testuser
```

```
$ fos:user:promote testuser ROLE_ADMIN
```

### USE

* IMPORTANT

Create at least one category before the first article.