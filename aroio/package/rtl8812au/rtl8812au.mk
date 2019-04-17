################################################################################
#
# RTL8812AU Driver
#
################################################################################

RTL8812AU_VERSION = ac063a4
#RTL8812AU_VERSION = 51ef8d50515d3b06a31a55598c238389ebaa9f15
RTL8812AU_SITE = git://github.com/gordboy/rtl8812au.git
#RTL8812AU_SITE = git://github.com/aircrack-ng/rtl8812au
RTL8812AU_SITE_METHOD = git
RTL8812AU_LICENSE = GPL-2.0
RTL8812AU_LICENSE_FILES = COPYING

RTL8812AU_MODULE_MAKE_OPT = \
	CONFIG_PLATFORM_ARM_RPI = y \
	CONFIG_PLATFORM_I386_PC = n \
	KVER=$(LINUX_VERSION_PROBED) \
	KSRC=$(LINUX_DIR)

#FOO_MODULE_SUBDIRS = core

#define RTL8812AU_BUILD_CMDS
#	CONFIG_PLATFORM_I386_PC=n \
#	CONFIG_PLATFORM_ARM_RPI=y \
#	KVER=$(LINUX_VERSION_PROBED) \
#	KSRC=$(LINUX_DIR) $(MAKE) -C $(@D) \
#	HOSTCC="$(HOST_DIR)/bin/ccache /usr/bin/gcc" \
#	HOSTCFLAGS="" \
#	ARCH=arm \
#	INSTALL_MOD_PATH=$(TARGET_DIR) \
#	CROSS_COMPILE="$(HOST_DIR)/bin/arm-buildroot-linux-gnueabihf-" \
#	DEPMOD=$(HOST_DIR)/sbin/depmod \
#	INSTALL_MOD_STRIP=1 \
#	PWD=$(BUILD_DIR)/rtl8812au-51ef8d50515d3b06a31a55598c238389ebaa9f15/. \
#	M=$(BUILD_DIR)/rtl8812au-51ef8d50515d3b06a31a55598c238389ebaa9f15/.
#	M=$(PWD)
#endef

$(eval $(kernel-module))
$(eval $(generic-package))
