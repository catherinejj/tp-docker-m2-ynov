# Étape de build
FROM node:24 AS build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Étape serveur de dev (pour ton cas local)
FROM node:24
WORKDIR /app
COPY . .
EXPOSE 5173
CMD ["npm", "run", "dev"]