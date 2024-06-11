FROM composer:2

ENV COMPOSERUSER=laravel
ENV COMPOSERGROUP=larvel


RUN adduser -g ${COMPOSERGROUP} -s /bin/sh -D ${COMPOSERUSER}