################################################################################
#
# bluez-alsa
#
################################################################################

BLUEZ_ALSA_VERSION = 9045edb436ea755f395a2e09e4525b5defad286a
BLUEZ_ALSA_SOURCE = bluez-alsa-$(BLUEZ_ALSA_VERSION).tar.gz
BLUEZ_ALSA_SITE = $(call github,Arkq,bluez-alsa,$(BLUEZ_ALSA_VERSION))
BLUEZ_ALSA_AUTORECONF = YES
BLUEZ_ALSA_INSTALL_STAGING = NO
#BLUEZ_ALSA_INSTALL_TARGET = YES
BLUEZ_ALSA_CONF_OPTS += --enable-aac
#--with-alsaplugindir=/usr/lib/alsa-lib
BLUEZ_ALSA_DEPENDENCIES = alsa-lib sbc fdk-aac

$(eval $(autotools-package))