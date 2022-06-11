FROM nginx:latest
MAINTAINER SprintF

RUN echo 'www-data ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

ARG UID
ARG GID

RUN usermod -u ${UID} www-data
RUN groupmod -g ${GID} www-data

WORKDIR /app

CMD ["nginx", "-g", "daemon off;"]
