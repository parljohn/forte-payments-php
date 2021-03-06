#!/usr/bin/make -f

SHELL:=/bin/bash

.PHONY: help init test test-only install-vendors update-vendors update-autoload


# Test that we have the necessary binaries available
define checkExecutables
	$(foreach exec,$(1),\
		$(if $(shell command -v $(exec)),,$(error Unable to find `$(exec)` in your PATH)))
endef


# Note that all comments with two hashes(#) will be used for output with `make help`. Alignment is tricky!
help:
	$(call checkExecutables, fgrep)
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'


##
## This is a list of available make commands that can be run.
##


init:                     ## Initializes the project and all dependencies
	$(call checkExecutables, composer)
	@make install-vendors


test:                     ## Runs all tests.
	$(call checkExecutables, docker)
	@vendor/bin/phpunit -d memory_limit=256M --configuration test/phpunit.xml


test-only:                ## Only runs tests with 'test-only' group annotation
	$(call checkExecutables, docker)
	@vendor/bin/phpunit -d memory_limit=256M --configuration test/phpunit.xml --group test-only


install-vendors:           ## Installs all the vendor lib dependencies.
	$(call checkExecutables, docker)
	@composer install


update-vendors:            ## Updates all the vendor lib dependencies.
	$(call checkExecutables, docker)
	@composer update


update-autoload:          ## Dump composer autoloader.
	$(call checkExecutables, docker)
	@composer dumpautoload
