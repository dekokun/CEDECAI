.PHONY : zip

zip:
	zip -r dekokun.zip . -x 'vendor/symfony/*' 'vendor/facebook/*' 'vendor/phpunit/*' '.git/*' '.idea/*'
