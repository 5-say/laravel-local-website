#!/bin/bash

cd sami

rm -rf build
rm -rf cache

# Run API Docs For Master
git clone https://github.com/laravel/framework.git laravel

php sami.php update config.php

cd ..
cp -r sami/build/* public/api/master
cd sami

rm -rf build
rm -rf cache

# Run API Docs For 4.1
cd laravel
git checkout -b 4.1 origin/4.1
cd ..

php sami.php update config.php

cd ..
cp -r sami/build/* public/api/4.1
cd sami

rm -rf build
rm -rf cache

# Run API Docs For 4.0
cd laravel
git checkout -b 4.0 origin/4.0
cd ..

php sami.php update config.php

cd ..
cp -r sami/build/* public/api/4.0
cd sami

rm -rf build
rm -rf cache

# Cleanup
rm -rf laravel
