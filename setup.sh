#!/bin/bash
set -e

if [ ! -f "src/composer.json" ]; then
    echo "Installing CodeIgniter 4.7..."
    docker run --rm -v "$(pwd)/src:/app" composer:latest \
        create-project codeigniter4/appstarter:^4.7 /app
    echo "CodeIgniter 4.7 installed."
else
    echo "CodeIgniter already installed. Running composer install..."
    docker run --rm -v "$(pwd)/src:/app" composer:latest \
        install --working-dir=/app
fi

echo ""
echo "Starting containers..."
docker compose up -d --build

echo ""
echo "============================================"
echo "App:        http://localhost:8080"
echo "phpMyAdmin: http://localhost:8090"
echo "DB:         localhost:3308"
echo "============================================"
