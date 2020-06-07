# Symfodex

This project is a Symfony discovery.
Purpose is to get a simple Pokedex, to explore entities, controllers, etc.

It also includes a search engine, based on ElasticSearch (**FOS/Elastica** bundle), and an admin UI based on **Sonata/Admin**.

Design is using Bootstrap 4.4 library: https://getbootstrap.com/docs/4.4/getting-started/introduction/.

## Versions
Yes, Symfony 5 is already up, but to be able to use **Sonata/Admin** and **FOS/Elastica**, I had to rollback to Symfony 4.
These package are in active development, so I hope I'll be able to upgrade back to Symfony 5 quickly.

## Requirements & installation
To run locally, you have to start a **Wodby4PHP** stack, here are the requirements: https://wodby.com/docs/stacks/php/local/

Local environment is all set, and you should only have to run one command to run the entire stack:
```
# from project root
make up
```

Once it's running, you may want to connect in the main docker, and install vendors using **composer**:
```
# from project root, with project running
make shell
# once in PHP docker
cd app/
composer install
```

Of course, database is empty, you'll have to run migrations to get data structure, and then fill database using Admin UI.
```
# run all migrations to create SQL tables
php bin/console doctrine:migrations:migrate --no-interaction
```

Or, you can find databases dump in build/local/ folder. Feel free to import one, using a command like:
```
# import a database (deprecated, as you can now import contents from PokeAPI V2
php bin/console doctrine:database:import ../build/local/40-pokemon.sql
# run all migrations to create SQL tables (just in case imported DB is too old)
php bin/console doctrine:migrations:migrate --no-interaction
```

For now, there is no homepage.
You can access and navigate Pokemon list here: http://symfodex.localhost:8765/pokemon
And Admin UI is here: http://symfodex.localhost:8765/admin/dashboard

## Elastic Search specificity

I don't know exactly why, but Elastic Search and Kibana dockers name are suffixed with *\_1*.
Also, Elastic Search indexes are on READONLY mode, even if populate command line would work correctly.

This is why an error such as `blocked by: [FORBIDDEN/12/index read-only / allow delete (api)];` is triggered.

Here are the two commands to fix that:
```
# from project root, with project running
make shell
# once in PHP docker
curl -XPUT -H "Content-Type: application/json" http://symfodex_elasticsearch_1:9200/_cluster/settings -d '{ "transient": { "cluster.routing.allocation.disk.threshold_enabled": false } }'
curl -XPUT -H "Content-Type: application/json" http://symfodex_elasticsearch_1:9200/_all/_settings -d '{"index.blocks.read_only_allow_delete": null}'
```

Source available here: https://selleo.com/til/posts/esrgfyxjee-how-to-fix-elasticsearch-forbidden12index-read-only

## Fill database using PokeAPI V2

Two routes are available to make a call to PokeAPI V2 and import contents:
* Types: http://symfodex.localhost:8765/papi/create/types
* Pokemons: http://symfodex.localhost:8765/papi/create/pokemons
  * For this route, pokemons are imported by batches of 20, but at the end, click the provided link to import next batch

Even better than routes, you can use command lines to fill your database:
```bash
# Connect into PHP docker
make shell
cd app/
# Fill types table
php bin/console app:papi-types
# Fill pokemons table (offset and limit are the two required arguments)
php bin/console app:papi-pokemon 0 151   # 1st gen.
php bin/console app:papi-pokemon 151 100 # 2nd gen.
```
### 3rd. generation
* [\#386 Deoxys](https://www.pokemon.com/us/pokedex/deoxys "Deoxys on pokemon.com") import will not work, because of its 4 forms.
```bash
php bin/console app:papi-pokemon 251 134 # 3rd gen. # some issues with 386 Deoxys (different forms)
```
### 4th. generation
* [\#413 Wormadam](https://www.pokemon.com/us/pokedex/wormadam "Wormadam on pokemon.com") import will not work, because of its 3 forms.
* [\#492 Shaymin](https://www.pokemon.com/us/pokedex/shaymin "Shaymin on pokemon.com") import will not work, because of its 2 forms.
```bash
php bin/console app:papi-pokemon 386 107 # 4th gen. # some issues with 413 Wormadam & 492 Shaymin (different forms)
```
### 5th. generation
* [\#386 Deoxys](https://www.pokemon.com/us/pokedex/deoxys "Deoxys on pokemon.com") import will not work, because of its 4 forms.
* [\#550 Basculin](https://www.pokemon.com/us/pokedex/basculin "Basculin on pokemon.com") import will not work, because of its 2 colors.
* [\#555 Darmanitan](https://www.pokemon.com/us/pokedex/darmanitan "Darmanitan on pokemon.com") import will not work, because of its 2 modes.
* [\#641 Tornadus](https://www.pokemon.com/us/pokedex/tornadus "Tornadus on pokemon.com") & [\#642 Thundurus](https://www.pokemon.com/us/pokedex/thundurus "Thundurus on pokemon.com") imports will not work, because of theirs 2 forms.
* [\#647 Keldeo](https://www.pokemon.com/us/pokedex/keldeo "Keldeo on pokemon.com") import will not work, not sure why though.
* [\#648 Meloetta](https://www.pokemon.com/us/pokedex/meloetta "Meloetta on pokemon.com") import will not work, because of its 2 forms.
```bash
php bin/console app:papi-pokemon 493 156
```

## Symfony command lines

Symfony comes with a lot of useful command lines. You can run these command lines in PHP docker, in the *app/* folder.
```
# from project root, with project running
make shell
# once in PHP docker
cd app/
php bin/console
```

## Bibliography

* To get a functional locale switcher: https://stackoverflow.com/questions/51597719/manually-switch-locale-in-symfony-4
* Help to configure Gedmo's translation package: https://blog.joeymasip.com/gedmo-translations-in-symfony-4/
* Data from PokeAPI V2: https://pokeapi.co/docs/v2
* Using a simple PHP wrapper by Dan Rovito: https://github.com/danrovito/pokephp
