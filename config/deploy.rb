# INITIAL CONFIGURATION
set :application, "priceshoes.com.co"
set :export, :remote_cache
set :keep_releases, 5
set :cakephp_app_path, "app"
set :cakephp_core_path, "cake"
#default_run_options[:pty] = true # Para pedir la contraseña de la llave publica de github via consola, sino sale error de llave publica.

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, "/home/prices10/public_html"

# USER & PASSWORD
set :user, 'prices10'
set :password, '4ALLmR2N4XJR'

# ROLES
role :app, "priceshoes.com.co"
role :web, "priceshoes.com.co"
role :db, "priceshoes.com.co", :primary => true

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
    run "cp /home/prices10/public_html/current/. /home/prices10/public_html/ -R"
    run "chmod 777 /home/prices10/public_html/app/tmp/ -R"
  end
  
end