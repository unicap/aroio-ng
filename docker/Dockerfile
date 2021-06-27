FROM ubuntu:18.04


ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/Berlin

RUN apt-get -y update
RUN DEBIAN_FRONTEND=noninteractive apt-get -y -q install build-essential sed make binutils bash patch gzip bzip2 tar cpio perl unzip rsync file bc git sudo wget python flex libssl-dev ccache libncurses5-dev nano


RUN adduser --disabled-password --gecos '' docker
RUN adduser docker sudo
RUN echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

WORKDIR /home/docker
RUN mkdir workdir
RUN chown docker.docker workdir

RUN sudo /usr/sbin/update-ccache-symlinks
RUN echo export PATH="/usr/lib/ccache:$PATH" >> /home/docker/.bashrc
RUN echo export CCACHE_DIR=/home/docker/workdir/.ccache >> /home/docker/.bashrc
