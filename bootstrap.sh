#!/usr/bin/env bash
echo "Provisioning virtual machine..."

echo "Initial Update"
apt-get update -y  

echo "Installing Git"
apt-get install git -y 

echo "Installing Nginx"
apt-get install nginx -y 

echo "Updating PHP repository"
apt-get install python-software-properties build-essential -y 
add-apt-repository ppa:ondrej/php -y 
apt-get update -y 

echo "Installing PHP"
apt-get install php7.1 php7.1-cli php7.1-fpm -y 

echo "Installing PHP extensions"
apt-get install curl php7.1-curl php7.1-gd php7.1-mcrypt php7.1-mysql php7.1-mbstring php7.1-xml -y 

echo "Configuring PHP"
# if you need custom files uncomment these.
# THE INCLUDED FILES ARE NOT UP TO DATE (They're from PHP 7.0)
# cp /var/www/provision/cli-php.ini /etc/php/7.0/cli/php.ini
# cp /var/www/provision/fpm-php.ini /etc/php/7.0/fpm/php.ini
phpenmod mbstring

echo "Installing PHPUnit"
wget https://phar.phpunit.de/phpunit.phar 
chmod +x phpunit.phar 
mv phpunit.phar /usr/local/bin/phpunit 

echo "Installing Composer"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer 

echo "Installing Zip"
apt-get install zip -y 

echo "Preparing MySQL"
# debconf-utils allows the root password to be inputed as a command line argument, needed for installation
apt-get install debconf-utils -y 
debconf-set-selections <<< "mysql-server mysql-server/root_password password pa33word"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password pa33word"

echo "Installing MySQL"
apt-get install mysql-server -y 

echo "Configuring MySQL"
cp /var/www/provision/my.cnf /etc/mysql/my.cnf  
sed -i 's/bind-address.*/bind-address = 0.0.0.0/' /etc/mysql/my.cnf  # This will overwrite any changes to my.cnf made for bind-address
service mysql restart  

echo "Configuring Nginx"
cp /var/www/provision/nginx_vhost /etc/nginx/sites-available/nginx_vhost 
ln -s /etc/nginx/sites-available/nginx_vhost /etc/nginx/sites-enabled/  
rm -rf /etc/nginx/sites-available/default  
service nginx restart 

echo "Installing Node/NPM"
apt-get update -y 
apt-get install nodejs-legacy -y 
apt-get install npm -y 

echo "Installing NPM Modules"
sudo npm install --global gulp  

echo "Setting up Project!!"
cd /var/www
sudo npm install

echo "Composer Install"
composer clear-cache
composer install --no-plugins --no-scripts > install.log

cp .env.example .env
php artisan key:generate >> install.log

echo "Complete!"
