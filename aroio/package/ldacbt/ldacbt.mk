################################################################################
#
# LDACBT
#
################################################################################

LDACBT_VERSION = fbffba45d15d959da6ee04eafe14c0d4721f6030
LDACBT_SOURCE = ldacBT-$(LDACBT_VERSION).tar.gz
LDACBT_SITE = $(call github,EHfive,ldacBT,$(LDACBT_VERSION))
LDACBT_SITE_METHOD = git
LDACBT_AUTORECONF = YES
LDACBT_GIT_SUBMODULES = YES
LDACBT_INSTALL_STAGING = YES
#LDACBT_INSTALL_TARGET = YES
LDACBT_CONF_OPTS = -DCMAKE_INSTALL_PREFIX=/usr -DINSTALL_LIBDIR=/usr/lib -DLDAC_SOFT_FLOAT=OFF ../

$(eval $(cmake-package))