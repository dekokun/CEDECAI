.PHONY : zip

zip:
	zip -r dekokun.zip . -x 'vendor/symfony/*' 'vendor/phpunit/*' '.git/*' '.idea/*'
