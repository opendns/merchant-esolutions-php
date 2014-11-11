.PHONY: coverage

test:
	vendor/bin/phpunit

coverage:
	vendor/bin/phpunit --coverage-text

coverage-clean:
	rm -rf coverage

coverage-html: coverage-clean
	vendor/bin/phpunit --coverage-html coverage

coverage-browser: coverage-html
	open coverage/index.html

docs:
	vendor/bin/apigen generate

doc: docs

docs-clean:
	rm -rf docs

docs-browser: docs
	open docs/index.html

clean: docs-clean coverage-clean
