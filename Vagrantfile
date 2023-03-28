#
Vagrant.configure("2") do |config|
 
  config.vm.box = "bento/ubuntu-18.04"

  config.vm.network "private_network", ip: "192.168.33.10"

  config.vm.provider "virtualbox" do |vb|
     vb.memory = "1024"
     vb.name = "Propel-Pizzaservice"
  end

   config.vm.provision "shell", inline: <<-SHELL
     apt-get update

     apt-get install -y php7.2-cli libapache2-mod-php7.2 php7.2-mysql php-pear php7.2-curl php7.2-gd php7.2-imap php7.2-mbstring php7.2-zip php7.2-sybase php7.2-intl php-xdebug

     php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
     php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
     php composer-setup.php
     php -r "unlink('composer-setup.php');"
     mv composer.phar /usr/local/bin/composer

     apt-get install -y git

     apt-get install -y php-pear

     apt-get install -y mysql-server

     apt-get install -y apache2
   SHELL
end
