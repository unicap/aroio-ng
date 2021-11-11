################################################################################
#
# spotifyd
#
################################################################################

#SPOTIFYD_VERSION = v0.2.24
SPOTIFYD_VERSION = v0.3.2
#SPOTIFYD_SOURCE = spotifyd-$(SPOTIFYD_VERSION).tar.gz
SPOTIFYD_SITE = $(call github,Spotifyd,spotifyd,$(SPOTIFYD_VERSION))
SPOTIFYD_LICENSE = GPL-3.0+
SPOTIFYD_LICENSE_FILES = COPYING

SPOTIFYD_DEPENDENCIES = host-cargo alsa-lib openssl
SPOTIFYD_CARGO_ENV = CARGO_HOME=$(HOST_DIR)/share/cargo \
					 PKG_CONFIG_ALLOW_CROSS=1
SPOTIFYD_CARGO_MODE = $(if $(BR2_ENABLE_DEBUG),debug,release)

SPOTIFYD_BIN_DIR = target/$(RUSTC_TARGET_NAME)/$(SPOTIFYD_CARGO_MODE)

SPOTIFYD_CARGO_OPTS = \
  --$(SPOTIFYD_CARGO_MODE) \
    --target=$(RUSTC_TARGET_NAME) \
    --manifest-path=$(@D)/Cargo.toml

define SPOTIFYD_BUILD_CMDS
	echo "#!/bin/bash" > $(HOST_DIR)/bin/arm-linux-gnueabihf-gcc
	echo "arm-buildroot-linux-gnueabihf-gcc \$$@" >> $(HOST_DIR)/bin/arm-linux-gnueabihf-gcc
	chmod guo+x $(HOST_DIR)/bin/arm-linux-gnueabihf-gcc
    $(TARGET_MAKE_ENV) $(SPOTIFYD_CARGO_ENV) \
            cargo build $(SPOTIFYD_CARGO_OPTS)
endef

define SPOTIFYD_INSTALL_TARGET_CMDS
    $(INSTALL) -D -m 0755 $(@D)/$(SPOTIFYD_BIN_DIR)/spotifyd \
            $(TARGET_DIR)/usr/bin/spotifyd
endef

$(eval $(generic-package))
