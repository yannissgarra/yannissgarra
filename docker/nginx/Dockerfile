FROM nginx:1.21

# ssl certificates
COPY ./certificate/localhost.crt /etc/ssl/certs/
COPY ./certificate/localhost.key /etc/ssl/private/

# server configuration
COPY ./conf.d/gateway.conf /etc/nginx/conf.d/gateway.conf
COPY ./conf.d/file-manager.conf /etc/nginx/conf.d/file-manager.conf

WORKDIR /www
EXPOSE 443