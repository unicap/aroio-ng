################################################################################
#
# ng-jackspa
#
################################################################################

NG_JACKSPA_VERSION = a33b2235447086a282f8795618d8b3c6b50c6299
NG_JACKSPA_SOURCE = ng-jackspa-$(NG_JACKSPA_VERSION).tar.gz
NG_JACKSPA_SITE = $(call github,7890,ng-jackspa,$(NG_JACKSPA_VERSION))
NG_JACKSPA_AUTORECONF = YES
NG_JACKSPA_INSTALL_STAGING = NO
#NG_JACKSPA_INSTALL_TARGET = YES

#NG_JACKSPA_CONF_OPTS = --prefix=/usr --disable-pcm-test --with-alsaplugindir=/usr/lib/alsa-lib --with-alsadatadir=/usr/share/alsa 

NG_JACKSPA_DEPENDENCIES = jack2

#define NG_JACKSPA_PRE_CONFIGURE_FIXUP
#	mkdir -p $(@D)/m4
#endef

#NG_JACKSPA_PRE_CONFIGURE_HOOKS += NG_JACKSPA_PRE_CONFIGURE_FIXUP

$(eval $(autotools-package))