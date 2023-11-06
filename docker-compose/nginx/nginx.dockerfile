FROM nginx:alpine

COPY localhost.key /etc/nginx/certs/nginx-selfsigned.key
COPY localhost.crt /etc/nginx/certs/nginx-selfsigned.crt