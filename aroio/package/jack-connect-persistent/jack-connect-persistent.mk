################################################################################
#
# jack_connect_persistent
#
################################################################################

JACK_CONNECT_PERSISTENT_VERSION = master
JACK_CONNECT_PERSISTENT_SOURCE = jack_connect_persistent-$(JACK_CONNECT_PERSISTENT_VERSION).tar.gz
JACK_CONNECT_PERSISTENT_SITE = $(call github,worosom,jack_connect_persistent,$(JACK_CONNECT_PERSISTENT_VERSION))

JACK_CONNECT_PERSISTENT_LICENSE = GPLv2
JACK_CONNECT_PERSISTENT_LICENSE_FILES = GPL-2.0
JACK_CONNECT_PERSISTENT_INSTALL_TARGET = YES
JACK_CONNECT_PERSISTENT_DEPENDENCIES = jack2
JACK_CONNECT_PERSISTENT_MAKE_OPTS = -DJACK

define JACK_CONNECT_PERSISTENT_BUILD_CMDS
        $(TARGET_CONFIGURE_OPTS) $(MAKE) CC="$(TARGET_CXX)"\
		OPTS="$(JACK_CONNECT_PERSISTENT_MAKE_OPTS)" -C $(@D) all
endef

define JACK_CONNECT_PERSISTENT_INSTALL_TARGET_CMDS
        $(INSTALL) -D -m 0755 $(@D)/jack_persistent_client $(TARGET_DIR)/usr/bin
endef

define JACK_CONNECT_PERSISTENT_PERMISSIONS
       /usr/bin/jack_persistent_client f 4755 0 0 - - - - - 
endef

$(eval $(generic-package))
