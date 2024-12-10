chmod 777 -R code

cd pavonChat_deployer

echo "Deploying PavonChat"

sudo docker compose up -d

echo "PavonChat deployed successfully"