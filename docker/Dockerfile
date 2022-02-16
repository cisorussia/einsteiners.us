FROM ubuntu:21.04

ARG BUILD_REPO
ARG BUILD_OWNER_REPO
ARG BUILD_COMMIT_SHA=""
ARG GIT_FOLDER=/var/www/html

LABEL maintainer="Ivan Kuchin"
LABEL org.opencontainers.image.source="https://github.com/${BUILD_OWNER_REPO}"

ENV COMPOSER_ALLOW_SUPERUSER 1

#####################
# changing timezone #
#####################
ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

##############################
# install basic dependencies #
##############################
RUN apt-get update
RUN apt-get install -y php7.4 php7.4-fpm php7.4-mysql php7.4-mbstring php7.4-xml php7.4-bcmath
RUN apt-get update
RUN apt-get install -y gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2

WORKDIR ${GIT_FOLDER}

###################
# copy sorce code #
###################
#RUN git clone https://github.com/einsteinersnet/einsteiners.net.git ./
COPY . ${GIT_FOLDER}

##################
# save commit id #
##################
RUN echo base commit#: ${BUILD_BASE_COMMIT_ID} > ./public/git_commit_id
RUN echo PR head commit#: ${BUILD_PR_HEAD_COMMIT_ID} >> ./public/git_commit_id

#########################
# composer dependencies #
#########################
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer update
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

###########################################
# move config file to separate dircetory  #
# this will help to mount it from k8s     #
###########################################
# RUN mkdir config_env && cp .env.example config_env/.env && ln -s config_env/.env
RUN ln -s ../.env ./public/.env

########################
# laravel dependencies #
########################
# RUN php artisan storage:link
# RUN php artisan livewire:publish
# RUN php artisan key:generate

EXPOSE 8000

#CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
CMD ["./docker/entrypoint.sh"]
