FROM node:alpine

# Copy files and install dependencies
COPY ./ /public
RUN npm install

# Install http server
RUN npm install --global --no-save http-server

# Port 8080 can be used as non root
EXPOSE 8080

# Create user with home directory and no password
RUN adduser -Dh /public server
USER server
WORKDIR /public

# Run server (-g will automatically serve the gzipped files if possible)
CMD ["/usr/local/bin/http-server", "/public"]
