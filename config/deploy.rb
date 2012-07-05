# INITIAL CONFIGURATION
set :application, "priceshoes.bloomweb.co"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
#default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/embalao/priceshoes.bloomweb.co"

# USER & PASSWORD
set :user, 'embalao'
set :password, 'rr40r900343'

# ROLES
role :app, "priceshoes.bloomweb.co"
role :web, "priceshoes.bloomweb.co"
role :db, "priceshoes.bloomweb.co", :primary => true

# VERSION TRACKER INFORMATION
set :scm, :git
set :use_sudo, false
set :repository,  "git@github.com:bloomtec/ez-cms.git"
set :branch, "master"

# TASKS
namespace :deploy do
  
  task :start do ; end
  
  task :stop do ; end
  
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cp /home/embalao/priceshoes.bloomweb.co/current/. /home/embalao/priceshoes.bloomweb.co/ -R"
    run "chmod 777 /home/embalao/priceshoes.bloomweb.co/app/tmp/ -R"
  end
  
end