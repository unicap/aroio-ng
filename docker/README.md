# Building "aroio-ng" with docker

## Prerequisites

"docker" needs to be installed on the host system. On Ubuntu, use the following command to install docker:

```
sudo snap install docker
```

Also "git" needs to be installed. On Ubuntu, use the following command to install git:

```
sudo apt install git
```

## Checking out the aroio-ng repository

Use the following command to clone the aroio-ng repository somewhere in your file system:

```
git clone --recursive https://github.com/unicap/aroio-ng
```

## Creating the docker container

The following commands create the docker container to be used to compile the system image:

```
cd aroio-ng
cd docker
sudo docker build -t aroio .
cd ..
```

This step needs to be done only once. The container will then stay permanent on the system.

## Log into the container and build the system image

Make sure you are in the top level directory of the "aroio-ng" repository.

Run the following commands to log into the container and build the system image:

```
sudo docker run -dit --mount type=bind,source="$(pwd)",target=/home/docker/workdir -t aroio:latest | tee container_id

sudo docker exec -it $(cat container_id) /bin/bash -l -c "su docker"
cd workdir
mkdir output
cd buildroot
make BR2_EXTERNAL=../aroio O=../output aroio_defconfig
cd ../output
make
```

To log out of the container enter the following command:

```
exit
```

To stop the container enter the following command:

```
sudo docker stop $(cat container_id)
```


Please note that any changes made inside of the container outside of the working directory "/home/docker/workdir" will be lost once you stop the container. If you need to install additional packages with "apt-get", you need to place those changes into the "Dockerfile" and re-create the container.
