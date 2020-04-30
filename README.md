# Symfodex

This project is a Symfony discovery.
Purpose is to get a simple Pokedex, to explore entities, controllers, etc.

It also includes a search engine, based on ElasticSearch (**FOS/Elastica** bundle), and an admin UI based on **Sonata/Admin**.

## Versions
Yes, Symfony 5 is already up, but to be able to use **Sonata/Admin** and **FOS/Elastica**, I had to rollback to Symfony 4.
These package are in active development, so I hope I'll be able to upgrade back to Symfony 5 quickly.

## Requirements & installation
To run locally, you have to start a **Wodby4PHP** stack, here are the requirements: https://wodby.com/docs/stacks/php/local/

Local environment is already configured, and you should only have to run one command to run the entire stack:
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

Of course, database is empty, you'll have to run migration to get data structure, and then fill database using Admin UI.

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

## Symfony command lines

Symfony comes with a lot of useful command lines. You can run these command lines in PHP docker, in the *app/* folder.
```
# from project root, with project running
make shell
# once in PHP docker
cd app/
php bin/console
```