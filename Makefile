.PHONY: dev win_dev prod win_prod destroy win_destroy

# build dev version of the Web frontend container 
dev:
	export MYSQL_HOST=mysql && \
	export MYSQL_USER=root && \
	export MYSQL_DATABASE=testdb && \
	export MYSQL_ROOT_PASSWORD=rootpassword && \
	export MONGO_HOST=mongo && \
	export MONGO_DATABASE=test-mongo-db && \
	export MONGO_INITDB_ROOT_USERNAME=root && \
	export MONGO_INITDB_ROOT_PASSWORD=rootpassword && \
	export ENVIRONMENT=dev && \
	docker compose up --build

win_dev:
    $env:MYSQL_HOST="mysql"; `
	$env:MYSQL_USER="root"; `
	$env:MYSQL_DATABASE="testdb"; `
	$env:MYSQL_ROOT_PASSWORD="rootpassword"; `
	$env:MONGO_HOST="mongo"; `
	$env:MONGO_DATABASE="test-mongo-db"; `
    $env:MONGO_INITDB_ROOT_USERNAME="root"; `
    $env:MONGO_INITDB_ROOT_PASSWORD="rootpassword"; `
    $env:ENVIRONMENT="dev"; `
	docker compose up --build
	

# build prod version of the Web frontend container 
prod:
	export MYSQL_HOST=mysql && \
	export MYSQL_USER=root && \
	export MYSQL_DATABASE=testdb && \
	export MYSQL_ROOT_PASSWORD=rootpassword && \
	export MONGO_HOST=mongo && \
	export MONGO_DATABASE=test-mongo-db && \
	export MONGO_INITDB_ROOT_USERNAME=root && \
	export MONGO_INITDB_ROOT_PASSWORD=rootpassword && \
	export ENVIRONMENT=prod && \
	docker compose up --build

win_prod:
    $env:MYSQL_HOST="mysql"; `
	$env:MYSQL_USER="root"; `
	$env:MYSQL_DATABASE="testdb"; `
	$env:MYSQL_ROOT_PASSWORD="rootpassword"; `
	$env:MONGO_HOST="mongo"; `
	$env:MONGO_DATABASE="test-mongo-db"; `
    $env:MONGO_INITDB_ROOT_USERNAME="root"; `
    $env:MONGO_INITDB_ROOT_PASSWORD="rootpassword"; `
    $env:ENVIRONMENT="prod"; `
	docker compose up --build

# clean up
destroy: 
	unset MYSQL_HOST && \
	unset MYSQL_USER && \
	unset MYSQL_DATABASE && \
	unset MYSQL_ROOT_PASSWORD && \
	unset MONGO_HOST && \
	unset MONGO_DATABASE && \
	unset MONGO_INITDB_ROOT_USERNAME && \
	unset MONGO_INITDB_ROOT_PASSWORD && \
	unset ENVIRONMENT && \
    docker compose down

win_destroy: 
    Remove-Item Env:\MYSQL_HOST; `
	Remove-Item Env:\MYSQL_USER; `
	Remove-Item Env:\MYSQL_DATABASE; `
	Remove-Item Env:\MYSQL_ROOT_PASSWORD; `
	Remove-Item Env:\MONGO_HOST; `
	Remove-Item Env:\MONGO_DATABASE; `
	Remove-Item Env:\MONGO_INITDB_ROOT_USERNAME; `
	Remove-Item Env:\MONGO_INITDB_ROOT_PASSWORD; `
	Remove-Item Env:\ENVIRONMENT; `
	docker compose down