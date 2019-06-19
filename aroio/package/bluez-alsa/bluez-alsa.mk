################################################################################
#
# bluez-alsa
#
################################################################################

#2018-03-02 - known to work ok
BLUEZ_ALSA_VERSION = 9045edb436ea755f395a2e09e4525b5defad286a

# 2018-12-16 - needs to be debugged, might work..
#BLUEZ_ALSA_VERSION = 49e3502eba94714b2a18f93deb6c66ddba73bd74

# 2019-03-28 - Doens't work, connects and disconnects again.
#BLUEZ_ALSA_VERSION = 3edbda8967170eb4fd45bd162a8eb6d07db0962d

# 2019-03-31 - Doens't work, connects and disconnects again.
# BLUEZ_ALSA_VERSION = b1688ad87a8b827dcf7c6b1d19e413724edd5915

# 2019-04-14 - Doens't work, connects and disconnects again.
#BLUEZ_ALSA_VERSION = 8505bab1fc3e9ba7cffe791f0993c93ebfce22bf

# ...
#BLUEZ_ALSA_VERSION = 680f904603097cca89e86a492147e223a73bb247






BLUEZ_ALSA_SOURCE = bluez-alsa-$(BLUEZ_ALSA_VERSION).tar.gz
BLUEZ_ALSA_SITE = $(call github,Arkq,bluez-alsa,$(BLUEZ_ALSA_VERSION))
BLUEZ_ALSA_AUTORECONF = YES
BLUEZ_ALSA_INSTALL_STAGING = NO
#BLUEZ_ALSA_INSTALL_TARGET = YES

BLUEZ_ALSA_CONF_OPTS = \
	--enable-debug \
	--disable-payloadcheck \
	--enable-aac \
	--enable-ldac \
	--disable-pcm-test \
	--with-alsaplugindir=/usr/lib/alsa-lib \
	--with-alsadatadir=/usr/share/alsa 
	

BLUEZ_ALSA_DEPENDENCIES = alsa-lib sbc fdk-aac ldacbt

define BLUEZ_ALSA_PRE_CONFIGURE_FIXUP
	mkdir -p $(@D)/m4
endef

BLUEZ_ALSA_PRE_CONFIGURE_HOOKS += BLUEZ_ALSA_PRE_CONFIGURE_FIXUP

$(eval $(autotools-package))
