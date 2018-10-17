################################################################################
#
# jack_connect_persistent
#
################################################################################

JACKCONNECTPERSISTENT_VERSION = master
JACKCONNECTPERSISTENT_SITE = git@github.com:worosom/jack_connect_persistent.git
JACKCONNECTPERSISTENT_LICENSE = GPLv2
JACKCONNECTPERSISTENT_LICENSE_FILES = GPL-2.0
JACKCONNECTPERSISTENT_INSTALL_TARGET = YES
JACKCONNECTPERSISTENT_DEPENDENCIES = libjack

define JACKCONNECTPERSISTENT_BUILD_CMDS
        $(MAKE) CC="$(TARGET_CPP)" LD="$(TARGET_LD)" -C $(@D) all
endef

define JACKCONNECTPERSISTENT_INSTALL_TARGET_CMDS
        $(INSTALL) -D -m 0755 $(@D)/jack_persistent_client $(TARGET_DIR)/bin
endef

define JACKCONNECTPERSISTENT_PERMISSIONS
       /bin/jack_persistent_client f 4755 0 0 - - - - - 
endef


$(eval $(generic-package))
