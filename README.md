# RES - Labo HTTP Infra 

Auteur : Gaëtan Daubresse 

## Step 1 : Static HTTP server with apache httpd 

Cette étape consiste à configurer un serveur http statique à l’aide d’un Docker. Pour ce faire nous avons utilisé l’image officiel php disponible sur le site dockerhub. Elle a l’avantage de contenir un serveur apache déjà configuré pour servir des pages php. 

Nous avons ensuite écrit un [Dockerfile](./docker-images/apache-php-image/Dockerfile) permettant de pouvoir construire cette image docker. Dans ce fichier nous avons indiqué la version d’apache que nous souhaitions utilisé à l’aide de l’instruction `FROM php:7.2-apache` . Nous avons également installé vim afin de pouvoir éditer des fichier à l’intérieur du conteneur avec l’instruction `RUN apt-get update && apt-get install -y vim ` . Pour finir nous avons copié les fichiers de configurations à l’intérieur du docker avec l’instruction `COPY content/ /var/www/html/` . 

Nous avons avons obtenu des fichiers de configuration en téléchargeant un template [boostrap](https://startbootstrap.com/templates/) et copié son contenu à l’intérieur de notre dossier content. Nous avons ensuite modifié légèrement le fichier [index.html](.//docker-images/apache-php-image/content/index.html) afin qu’il corresponde à ce que nous voulions. Ceci permettra d’avoir une mise en page plus jolie. 

 Nous pouvons ensuite construire l’image depuis le dossier courant à l’aide de la commande `docker build -t res/apache_php . ` et démarrer un conteneur avec la commande `docker run -p 8080:80 res/apache_php` . 

