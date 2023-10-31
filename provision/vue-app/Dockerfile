# Use an official Node.js runtime as a parent image
FROM node:18-alpine

# Set the working directory within the container
WORKDIR /app

COPY ../../vue-app /app

RUN npm init -y

# Install project dependencies
RUN npm install

# Build your Vue.js application
RUN npm run build

# Expose the port your Vue.js application will run on (e.g., 8080)
EXPOSE 8080


