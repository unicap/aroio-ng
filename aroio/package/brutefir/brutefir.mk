################################################################################
#
# brutefir
#
################################################################################

BRUTEFIR_VERSION = 1.0m
BRUTEFIR_SOURCE = brutefir-$(BRUTEFIR_VERSION).tar.gz
BRUTEFIR_SITE = http://www.ludd.luth.se/~torger/files
BRUTEFIR_LICENSE = GPLv2
BRUTEFIR_LICENSE_FILES = GPL-2.0
BRUTEFIR_INSTALL_STAGING = NO
BRUTEFIR_DEPENDENCIES = fftw fftw3f jack2

ifeq ($(KERNEL_ARCH),arm)
define BRUTEFIR_BUILD_CMDS
	$(MAKE) UNAME_M="armv7" LIBPATHS="-L$(STAGING_DIR)/usr/lib" INCLUDE="-I$(STAGING_DIR)/usr/include" CC="$(TARGET_CC)" LD="$(TARGET_LD)" -C $(@D) all
endef
else
define BRUTEFIR_BUILD_CMDS
	kartoffel
	$(MAKE) LIBPATHS="-L$(STAGING_DIR)/usr/lib" INCLUDE="-I$(STAGING_DIR)/usr/include" CC="$(TARGET_CC)" LD="$(TARGET_LD)" -C $(@D) all
endef
endif

ifeq ($(KERNEL_ARCH),arm)
define BRUTEFIR_INSTALL_STAGING_CMDS
	$(MAKE) UNAME_M="armv7" INSTALL_PREFIX=$(STAGING_DIR)/usr -C $(@D) install
endef
else
define BRUTEFIR_INSTALL_STAGING_CMDS
	$(MAKE) INSTALL_PREFIX=$(STAGING_DIR)/usr -C $(@D) install
endef
endif

ifeq ($(KERNEL_ARCH),arm)
define BRUTEFIR_INSTALL_TARGET_CMDS
	$(MAKE) UNAME_M="armv7" INSTALL_PREFIX=$(TARGET_DIR)/usr -C $(@D) install
endef
else
define BRUTEFIR_INSTALL_TARGET_CMDS
	$(MAKE) INSTALL_PREFIX=$(TARGET_DIR)/usr -C $(@D) install
endef
endif

$(eval $(generic-package))
