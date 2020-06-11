################################################################################
#
# host-prelink-cross
#
################################################################################

HOST_PRELINK_CROSS_VERSION = 05aeafd053e56356ec8c62f4bb8f7b95bae192f3
HOST_PRELINK_CROSS_SITE = git://git.yoctoproject.org/prelink-cross
HOST_PRELINK_CROSS_SITE_METHOD = git
HOST_PRELINK_CROSS_LICENSE = GPL-2.0
HOST_PRELINK_CROSS_LICENSE_FILES = COPYING
HOST_PRELINK_CROSS_AUTORECONF = YES
HOST_PRELINK_CROSS_DEPENDENCIES = host-binutils

$(eval $(host-autotools-package))
