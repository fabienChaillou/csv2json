.PHONY: help

default: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?##.*$$' $(MAKEFILE_LIST) | sort | awk '{split($$0, a, ":"); printf "\033[36m%-30s\033[0m %-30s %s\n", a[1], a[2], a[3]}'

#
# Make sure to run the given command in a container identified by the given service.
#
# $(1) the user with which run the command
# $(2) the Docker Compose service
# $(3) the command to run
#
define run-in-container
	@if [ $$(env|grep -c "^CI=") -eq 1 ]; then \
		docker-compose exec --user $(1) -T $(2) /bin/sh -c "$(3)"; \
	elif [ ! -f /.dockerenv ]; then \
		docker-compose exec --user $(1) $(2) /bin/sh -c "$(3)"; \
	else \
		$(3); \
	fi
endef

#
# Executes a command in a running container, mainly useful to fix the terminal size on opening a shell session
#
# $(1) the options
#
define infra-shell
	docker-compose exec -e COLUMNS=`tput cols` -e LINES=`tput lines` $(1)
endef


########################################
#                APP                   #
########################################
.PHONY: app-run-cmd

app-run-cmd: ## to install backend dependencies
	$(call run-in-container,)

########################################
#              INFRA                   #
########################################
.PHONY: infra-shell-php infra-up

infra-shell-php: ## to open a shell session in the php-fpm container
	@$(call infra-shell,-u www-data php_cli sh)

infra-up: ## to start all the containers
	@docker-compose up --build -d
