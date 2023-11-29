#!/bin/bash

showHelp() {
	echo ""
	echo "SCRIPT HELP"
	echo "-----------"
	echo "Parâmetro (funcionalidade):"
	echo "   [help ] - Apresentar Help (bash load.sh help)"
	echo "   [run  ] - Executar todos os containers (bash load.sh run)"
	echo "          => [php    ] - Ambiente PHP puro"
	echo "          	+ [Terminal/Exec] - service apache2 restart"
	echo "          => [laravel] - Ambiente Framework Laravel"
	echo "          	+ [Terminal/Exec] - service apache2 restart"
	echo "          	+ [Terminal/Exec] - cd /var/www/html/start-project"
	echo "          	+ [Terminal/Exec] - php artisan serve --host 0.0.0.0"
	echo "   [stop ] - Parar a execução de todos os containers (bash load.sh stop)"
	echo "   [list ] - Listar todos os containers em execução (bash load.sh stop)"
	echo "   [ip ci] - Obter o endereço IP do container com ID=ci (bash run.sh ip container_id)"
}

runAll() {
	
	echo ""
	echo "LOADING ALL DOCKER CONTAINERS"
	echo "-----------------------------"
	echo "1) Starting MySQL Container..."
	docker run --name mysql -e MYSQL_ROOT_PASSWORD=root -d gileduardo/mysql:v1
	echo "   MySQL Container Loaded! $id"
	echo "-----------------------------"
	echo "2) Starting PhpMyAdmin Container [PORT: 8090]..."
	docker run --name phpmyadmin -d --link mysql:db -p 8090:80 gileduardo/phpmyadmin:v1
	echo "   phpMyAdmin Container Loaded! [USER: root / PASSWORD: root]"
	echo "-----------------------------"
	if [[ $1 -eq 0 ]]
	then
		echo "3) (PHP) Starting Apache2 + PHP 8.2 Container [PORT: 8080]..."
		docker run -it --name server -p 8080:80 -v ${PWD}:/var/www/html/ gileduardo/apache:v1 bash
	else
		echo "3) (LARAVEL) Starting Apache2 + PHP 8.2 Container [PORT: 8080]..."
		docker run -it --rm --name server -p 8080:8000 -v ${PWD}:/var/www/html/ gileduardo/apache:v1 bash
	fi
	
	echo "   Apache2 + PHP 8.2 Container Loaded!"
	echo "-----------------------------"
	echo "[OK] All Containers have been loaded..."	
	echo "-----------------------------"
}

stopAll() {
	echo ""
	echo "STOPPING ALL DOCKER CONTAINERS"
	echo "------------------------------"
	docker rm -f $(docker ps -a -q)
	echo "[OK] All Docker Containers was stoped..."
	echo "-----------------------------"
}

if [[ $# -eq 0 || $1 = "help" ]]
then
	showHelp	

elif [ $1 = "run" ]
then
	if [ $# -lt 2 ]
	then
		showHelp	
		
	elif [ $2 = "php" ]
	then
		runAll 0
		
	elif [ $2 = "laravel" ]
	then
		runAll 1
		
	else 
		showHelp
	fi
	
elif [ $1 = "stop" ]
then
	stopAll

elif [ $1 = "list" ]
then
	docker ps
	
elif [ $1 = "ip" ]
then
	if [ $# -lt 2 ]
	then
		echo ""	
		echo "[ERROR] TOW FEW PARAMETERS"
		echo "-----------"
		echo "Por favor, execute 'bash load.sh help' para mais detalhes!"
		echo "-----------"		
	else
		docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $2
	fi
else
    echo ""	
    echo "[ERROR] INVALID PARAMETERS"
    echo "-----------"
    echo "Por favor, execute 'bash load.sh help' para mais detalhes!"
    echo "-----------"
fi

echo "" 


<<comment
 "Code" or "Comments
comment
