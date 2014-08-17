.PHONY : zip

zip:
	rm dekokun.zip && zip -r dekokun.zip . -x 'vendor/symfony/*' 'vendor/facebook/*' 'vendor/phpunit/*' '.git/*' '.idea/*'
