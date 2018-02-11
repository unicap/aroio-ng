Aroio Buildroot


To initialize this buildroot:

```
git clone --recurse-submodules git@github.com:unicap/aroio-ng.git
cd aroio-ng/buildroot
mkdir /output/
make BR2_EXTERNAL=../aroio O=/output/aroio aroio_defconfig
```

Build image:

```
cd /output/aroio
make
```
