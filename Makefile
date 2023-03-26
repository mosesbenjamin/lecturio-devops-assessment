.PHONY: dev prod destroy

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
