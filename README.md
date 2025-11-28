A simple template to build php web-app that is already configured with apache (a2enmod rewrite) and .htacces for pretty url

** if you're using vscode make sure to download Devcontainer extension and Breww to ensure inIntelephense runs inside the container for code intelligence.



Packages for debian has already been installed.

If ever you need more packages, update the list in Dockerfile 

Localhost:8080 web root var/html/public
Localhost:8081 phpmyadmin

Docker images used
{ 
    php:8.4-apache-trixie,
    mysql:8.0,
    phpmyadmin
}

*Note: 
    {
        Go through the docker-compose.yml file to setup container names, and some Database and phpmyadmin configs.
        This is just a template, you can change whatever you want and feel free to share your version.
    }
    
