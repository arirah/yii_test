# Setup

Install Docker https://www.docker.com/get-started

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
Run database migration (creating tables)

    docker-compose run --rm php yii migrate    
    docker-compose run --rm php tests/bin/yii migrate    
        
You can then access the application through the following URL:

    http://127.0.0.1:8000

## Database

The database consists of two tables created for you ```loan``` and ```user```. Each User can have multiple Loans. Each loan must have a User. 