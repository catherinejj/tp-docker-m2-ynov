# Étape 1 : Build du frontend
FROM node:24 AS build
WORKDIR /app

COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Étape 2 : Serveur Nginx pour la prod
FROM nginx:1.27-alpine
COPY --from=build /app/dist /usr/share/nginx/html

# Exposer le port HTTP standard
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]