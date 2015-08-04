
# INSEEGEAO

Add insee_geo_department, insee_geo_municipality and insse_geo_region for France.
Give departments and region hook.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is INSEEGeo,
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require thelia/insee-geo-module:~1.0
```

## Hook

``` {hook type="insee_geo.front.insert_select_city" formField="city" modulecode="INSEEGeo"}```
Front Office Hook to show select-city form type in your form.

## Loop

There are 2 loops :

[insee.geo.departement] : to give department, according to locale.

### Input arguments

|Argument |Description |
|---      |--- |
| id | DB identifying, administrative number |

### Output arguments

| Variable | Description |
|----------|-------------|
| ID    | DB identifying, administrative number |
| NAME  | Department name |
| CREATED_AT    |   |
| UPDATE_AT     |   |

[insee.geo.region] : to give region, according to locale.

### Input arguments

|Argument |Description |
|---      |--- |
| id | DB identifying, INSEE code |

### Output arguments

| Variable | Description |
|----------|-------------|
| ID    | DB identifying, INSEE code |
| NAME  | Region name |
| CREATED_AT    |   |
| UPDATE_AT     |   |

## Handler

[insee_geo.handler.insee_geo] : To give data in BackEnd.
``` getCityByZipCode ``` to give city by zip code.

==========================
== fr_FR ==

# INSEE Geo

Ajoute les tables insee_geo_department, insee_geo_municopality et insee_geo_region pour la toute la France.
Fournit des hook sur les départements et les régions (avant 1er janvier 2016).

## Installation

### Manually

* Copier le module dans le dossier ```<thelia_root>/local/modules/``` et s'assurer que le nom du module est INSEEGeo,
* Activer le dans le pannal d'administratiion de Thelia.

### Composer

Ajouter le dans le fichier composer.json de Thelia

```
composer require thelia/insee-geo-module:~1.0
```

## Hook

``` {hook type="insee_geo.front.insert_select_city" formField="city" modulecode="INSEEGeo"}```
Hook niveau Front Office pour l'affiche du form type select-city dans votre formulaire


## Loop

Il y a 2 loops :

[insee.geo.departement] : pour récupérer les départements, suivant la locale.

### Input arguments

|Argument |Description |
|---      |--- |
| id | Identifiant BdD, numéro administratif |

### Output arguments

| Variable | Description |
|----------|-------------|
| ID    | Identifiant BdD, numéro administratif |
| NAME  | Nom du département |
| CREATED_AT    |   |
| UPDATE_AT     |   |

[insee.geo.region] : pour récupérer les régions, suivant la locale.

### Input arguments

|Argument |Description |
|---      |--- |
| id | Identifiant BdD, code INSEE |

### Output arguments

| Variable | Description |
|----------|-------------|
| ID    | Identifiant BdD, code INSEE |
| NAME  | Nom de la région |
| CREATED_AT    |   |
| UPDATE_AT     |   |

## Handler

[insee_geo.handler.insee_geo] : Pour récupérer les données niveau BackEnd
``` getCityByZipCode ``` pour récupérer le ville à partir du code postal.

