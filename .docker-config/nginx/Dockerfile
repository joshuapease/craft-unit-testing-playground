FROM nginx:1.17.6

ARG SSL_CERT_DOMAIN

RUN apt-get update && apt-get install -y openssl

RUN mkdir /etc/ssl/self-signed

# Create a self signed certificate
RUN  openssl req -x509 -nodes -days 365 \
  -subj  "/C=CA/ST=QC/O=craftunit/CN=${SSL_CERT_DOMAIN}" \
  -addext "subjectAltName=DNS:${SSL_CERT_DOMAIN}" \
  -newkey rsa:2048 -keyout /etc/ssl/self-signed/self-signed.key \
  -out /etc/ssl/self-signed/self-signed.crt;

COPY ./.docker-config/nginx/default.conf /etc/nginx/conf.d/default.conf
