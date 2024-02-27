PROJECT        ?= $(shell basename $(CURDIR))
DOCKER_COMPOSE := docker-compose --project-name ${PROJECT}

.PHONY: build
build: ## Build all containers
	${DOCKER_COMPOSE} build

.PHONY: build.verbose
build.verbose: ## Build all containers with a verbose output
	${DOCKER_COMPOSE} --verbose build

.PHONY: up
up: ## Bring up all containers
	${DOCKER_COMPOSE} up --detach --remove-orphans

.PHONY: logs
logs:
	${DOCKER_COMPOSE} logs app --follow

.PHONY: stop
stop: ## Stop all containers, but retain network
	${DOCKER_COMPOSE} stop

.PHONY: shell
shell: ## Run a shell session on a container
	${DOCKER_COMPOSE} exec app bash

.PHONY: shell.db
shell.db: ## Run a psql session on the local database
	${DOCKER_COMPOSE} exec db psql -U postgres tracker

.PHONY: shell.tinker
shell.tinker: ## Run a Tinker session on a container
	${DOCKER_COMPOSE} exec app php artisan tinker
