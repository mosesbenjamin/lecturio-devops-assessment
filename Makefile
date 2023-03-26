.PHONY: dev prod destroy

# build dev version of the Web frontend container 
dev:
	export ENVIRONMENT=dev && docker compose up --build

# build prod version of the Web frontend container 
prod:
	docker compose up --build

# clean up
destroy: 
	unset ENVIRONMENT && docker compose down
