################################################################################
#
# bluez-alsa
#
################################################################################

#2018-03-02 - known to work ok
BLUEZ_ALSA_VERSION = 9045edb436ea755f395a2e09e4525b5defad286a

# 2018-12-16 - needs to be debugged, might work..
#BLUEZ_ALSA_VERSION = 49e3502eba94714b2a18f93deb6c66ddba73bd74

BLUEZ_ALSA_SOURCE = bluez-alsa-$(BLUEZ_ALSA_VERSION).tar.gz
BLUEZ_ALSA_SITE = $(call github,Arkq,bluez-alsa,$(BLUEZ_ALSA_VERSION))
BLUEZ_ALSA_AUTORECONF = YES
BLUEZ_ALSA_INSTALL_STAGING = NO
#BLUEZ_ALSA_INSTALL_TARGET = YES

BLUEZ_ALSA_CONF_OPTS = --disable-payloadcheck --enable-aac --prefix=/usr --disable-pcm-test --with-alsaplugindir=/usr/lib/alsa-lib --with-alsadatadir=/usr/share/alsa 

BLUEZ_ALSA_DEPENDENCIES = alsa-lib sbc fdk-aac

define BLUEZ_ALSA_PRE_CONFIGURE_FIXUP
	mkdir -p $(@D)/m4
endef

BLUEZ_ALSA_PRE_CONFIGURE_HOOKS += BLUEZ_ALSA_PRE_CONFIGURE_FIXUP

$(eval $(autotools-package))
