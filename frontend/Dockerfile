# Use the official Node.js image with Alpine Linux
FROM node:20-alpine

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy the rest of the application
COPY . .

# Expose the port Vite uses
#EXPOSE 5173

# Default command to start the development server
CMD ["npm", "run", "dev"]
#CMD ["npm", "run", "build"]