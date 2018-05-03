Vagrant.configure(2) do |config|

  # Set Box
  config.vm.box = "ubuntu/trusty32"

  # Setup Share Folder
  config.vm.synced_folder "./", "/var/www", create:true, owner:"www-data", group:"www-data", mount_options:["dmode=777,fmode=777"]

  # Setup Network
  config.vm.network "private_network", type: "dhcp"
  config.vm.network :forwarded_port, guest: 80, host: 8972, auto_correct: true # Forward Web Port
  config.vm.network :forwarded_port, guest: 3306, host: 8973, auto_correct: true # Forward MySQL Port

  # Configure Box "Hardware"
  config.vm.provider "virtualbox" do |vb|
    ### Change network card to PCnet-FAST III
    ### The default Intel card virtualbox wanted to use wasn't working
    # For NAT adapter
    vb.customize ["modifyvm", :id, "--nictype1", "Am79C973"]
    # For host-only adapter
    vb.customize ["modifyvm", :id, "--nictype2", "Am79C973"]
    # moar memory
    vb.customize ["modifyvm", :id, "--memory", "4096"]
  end

  ### Uncomment to debugg init errors
  #config.vm.provider :virtualbox do |vb|
  #  vb.gui = true
  #end

  # shell script
  config.vm.provision :shell, path: "bootstrap.sh"

end
